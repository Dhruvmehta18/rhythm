const playlist_image_folder_path='\\rhythm\\playlist\\';
const song_folder_path = '\\rhythm\\songs\\';
const image_folder_path = '\\rhythm\\images\\';

class Song {
  constructor(songId, songName, songAudioUrl, songImageUrl, songDuration = 0, artists = '', album = '', rating=0) {
    this.songId = songId;
    this.songName = songName;
    this.songAudioUrl = songAudioUrl;
    this.artists = artists;
    this.songImageUrl = songImageUrl;
    this.songDuration = songDuration;
    this.album = album;
    this.rating = rating;
  }
  // Getter Methods
  get getSongName() {
    return this.songName;
  }
  get getSongAudioUrl() {
    return this.songAudioUrl;
  }
  get getArtists() {
    return this.artists;
  }
  get getSongImageUrl() {
    return this.songImageUrl;
  }
  get getSongDuration() {
    return this.songDuration;
  }
  get getAlbum() {
    return this.album;
  }
  get getRating(){
    return this.rating;
  }
}
const previndex=-1;
class SongsQueue {
  constructor(songsList, listType, queueTitle, queueImageUrl) {
    if (!sessionStorage.queue) {
      sessionStorage.setItem("queue",JSON.stringify([]));
    }
    SongsQueue.type = ['playlist', 'album', 'genre'];
    this.songsList = Array.isArray(songsList) ? songsList : [];
    this.listType = (typeof listType !== 'undefined' &&
      typeof listType === 'string' &&
      listType !== '') ? listType : SongsQueue.type[0];
    this.queueTitle = (typeof queueTitle === 'string' && queueTitle !== '') ? queueTitle : SongsQueue.type[0];
    this.queueImageUrl = (typeof queueImageUrl !== 'undefined' &&
      typeof queueTitle === 'string' &&
      queueTitle !== '' &&
      this.listType !== SongsQueue.type[0]) ? queueImageUrl : '';
    this.initializeQueueList();
  }
  initializeRepeat() {
    this.setRepeat();
  }
  initializeQueueList(array) {
    if (typeof array === 'undefined') {
      if (!this.queueList) {
        this.queueList = this.getAllSongsData;
      } else {
        this.setQueueList(this.getAllSongsData);
      }
    } else {
      this.setQueueList(array);
    }
    this.setQueueCurrent(0);
    this.initializeRepeat();
  }
  // Getter Methods
  get getAllSongsData() {
    return this.songsList;
  }
  get length() {
    return this.getQueueList.length;
  }
  get getQueueTitle() {
    return this.queueTitle;
  }
  get getQueueImageUrl() {
    return this.queueImageUrl;
  }
  get getQueueList() {
    return this.queueList;
  }
  get nextSong() {
    this.queueCurrent+=1;
    return this.queueList[(this.queueCurrent) % this.length];
  }
  get getRepeat() {
    return this.repeat;
  }
  get currentIndex() {
    return this.queueCurrent;
  }
  // add songs to queue
  get play() {
    if (this.queueCurrent >= this.length) {
      if (this.getRepeat == 1) {
        this.next();
      } else if (this.getRepeat == 2) {
        this.queueCurrent = this.queueCurrent - 1;
      }
    }
    const song = this.queueList[this.queueCurrent];
    let prevQueue = JSON.parse(sessionStorage.queue);
    let prevSong = prevQueue[prevQueue.length-1];
    if (typeof prevSong ==='undefined' ||prevSong.songAudioUrl !== song.songAudioUrl) {
      prevSong = song;
      const q = prevQueue;
      q.push(prevSong);
      sessionStorage.queue=JSON.stringify(q);
    }
    const queue = JSON.parse(sessionStorage.queue);
    return queue[queue.length-1];
  }
  get checkNext() {
    if (this.getRepeat == 0) {
      return this.currentIndex < this.length - 1;
    } else {
      return true;
    }
  }
  prevSong(){
    const song = this.queueList[this.queueCurrent];
    const prevQueue = JSON.parse(sessionStorage.queue);
    --previndex;
    let prevSong = prevQueue[prevQueue.length+previndex];
    if(prevSong.songAudioUrl === song.songAudioUrl){
      if(previndex<0&&prevQueue.length>1){
      --previndex;
      prevSong=prevQueue[prevQueue.length+previndex];
      }
      else{
        return song;
      }
    }
    return prevSong;
  }
  // Setter Methods
  /**
   * @param {Song[]} array
   */
  setSongData(array = []) {
    this.songsList = Array.isArray(array) ? array : [];
    this.initializeQueueList();
  }
  /**
   * @param {string} title
   */
  setQueueTitle(title) {
    if (this.queueTitle === SongsQueue.type[0]) {
      this.queueTitle = title;
    }
  }
  /**
   * @param {string} url
   */
  setQueueImageUrl(url) {
    if (this.queueTitle === SongsQueue.type[0]) {
      this.queueImageUrl = url;
    }
  }
  /**
   * @param {Array} array
   */
  setQueueList(array) {
    this.queueList = array;
    this.initializeRepeat();
  }
  setQueueCurrent(id = 0) {
    this.queueCurrent = id;
  }
  setRepeat(type = 0) {
    this.repeat = type;
  }
  // Methods of Songs Queue

  next() {
    switch (this.getRepeat) {
      case 0:
        const temp0 = (this.queueCurrent + 1);
        this.setQueueCurrent(temp0);
        break;
      case 1:
        const temp1 = (this.queueCurrent + 1) % this.length;
        this.setQueueCurrent(temp1);
        break;
    }
  }
  addSong(song) {
    this.queueList.push(song);
  }
  setSong(id) {
    let temp = 0;
    for (let i = 0; i < this.length; i++){
      const song = this.queueList[i];
      if(song.songId==id){
        temp=i;
        break;
      }
    }
    this.setQueueCurrent(temp);
  }
  // get songs from queue by id
  getQueueSong(id = 0) {
    let temp = 0;
    for (let i = 0; i < this.length; i++){
      const song = this.queueList[0];
      if(song.songId==id){
        temp=i;
        br
      }
    }
    return this.queueList[temp];
  }
  repeatSong() {
    this.setRepeat((this.repeat + 1) % 3);
    return this.getRepeat;
  }
  addNextToList(id) {
    const song = this.getQueueSong(id);
    this.queueList.unshift(song);
  }
  shuffle() {
    const array = this.getAllSongsData;
    let currentIndex = this.length; let temporaryValue; let randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;

      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }

    this.initializeQueueList(array);
  }
}

const commandMusicController = {
  queueController: function () {
    let songsQueueObject;
    checkSong = () => {
      return typeof songsQueueObject !== 'undefined';
    };
    const commands = {
      queueInit: function (songsList, listType, queueTitle, queueImageUrl) {
        songsQueueObject = new SongsQueue(songsList, listType, queueTitle, queueImageUrl);
      },
      getAllSongs: function () {
        const check = checkSong();
        return check && songsQueueObject.getAllSongsData;
      },
      getQueueLength: function () {
        const check = checkSong();
        return check && songsQueueObject.length;
      },
      getTitle: function () {
        const check = checkSong();
        return check && songsQueueObject.getQueueTitle;
      },
      getImageUrl: function () {
        const check = checkSong();
        return check && songsQueueObject.getQueueImageUrl;
      },
      getQueue: function () {
        const check = checkSong();
        return check && songsQueueObject.getQueueList;
      },
      getSong: function (id) {
        const check = checkSong();
        return check && songsQueueObject.getQueueSong(id);
      },
      nextSong: function () {
        const check = checkSong();
        return check && songsQueueObject.nextSong;
      },
      prev:function(){
        const check = checkSong();
        return check && songsQueueObject.prevSong();
      },
      next: function () {
        const check = checkSong();
        return check && songsQueueObject.next();
      },
      play: function () {
        const check = checkSong();
        return check && songsQueueObject.play;
      },
      setSongData: function (array) {
        const check = checkSong();
        return check && songsQueueObject.setSongData(array);
      },
      setTitle: function (title) {
        const check = checkSong();
        return check && songsQueueObject.setQueueTitle(title);
      },
      setImageUrl: function (url) {
        const check = checkSong();
        return check && songsQueueObject.setSongImageUrl(url);
      },
      setQueue: function (array) {
        const check = checkSong();
        return check && songsQueueObject.setQueueList(array);
      },
      addSong: function (song) {
        const check = checkSong();
        return check && songsQueueObject.addSong(song);
      },
      repeatSong: function () {
        const check = checkSong();
        return check && songsQueueObject.repeatSong();
      },
      addNextSong: function (id) {
        const check = checkSong();
        return check && songsQueueObject.addNextToList(id);
      },
      checkNext: function () {
        const check = checkSong();
        return check && songsQueueObject.checkNext;
      },
      shuffle: function () {
        const check = checkSong();
        return check && songsQueueObject.shuffle();
      },
      setSong: function (id) {
        const check = checkSong();
        return check && songsQueueObject.setSong(id);
      }
    };
    return {
      commands,
    };
  },
  songs: function (song) {
    let songs = (typeof song !== 'undefined' && song instanceof Song) && song;
    checkInstanceSong = () => {
      return (songs instanceof Song);
    };
    const commands = {
      init: function (...args) {
        songs = new Song(...args);
        return songs;
      },
      getName: function () {
        const check = checkInstanceSong();
        return check && songs.getSongName;
      },
      getAudioUrl: function () {
        const check = checkInstanceSong();
        return check && songs.getSongAudioUrl;
      },
      getArtists: function () {
        const check = checkInstanceSong();
        return check && songs.getArtists;
      },
      getImageUrl: function () {
        const check = checkInstanceSong();
        return check && songs.getSongImageUrl;
      },
      getDuration: function () {
        const check = checkInstanceSong();
        return check && songs.getSongDuration;
      },
      getAlbum: function () {
        const check = checkInstanceSong();
        return check && songs.getAlbum;
      },
    };
    return {
      commands,
    };
  },
};

const queueCommands = commandMusicController.queueController().commands;
// const songsCommands = commandMusicController.songs().commands;
// const songsl = songsCommands.init(2, '34', 'song1.mp3', 'sfsd', 432423, 'asda', 'dasd');

// const song2 = songsCommands.init(2, '34', 'song.mp3', 'sfsd', 432423, 'asda', 'dasd');
// console.log(songsl);
// queueCommands.queueInit([songsl, song2], 'album', 'hello', 'askajs');
// console.log(queueCommands.getAllSongs());

class Card {
  constructor(cardId, cardName = '', cardUrl = '', cardImage = '', description = '', cardType = 0) {
    this.card_id = cardId;
    this.cardName = cardName;
    this.cardUrl = cardUrl;
    this.cardImage = cardImage;
    this.description = description;
    this.cardType = cardType;
    Object.defineProperty(this, 'playing', {
      value: false,
      writable: true,
      configurable: false,
    });
    const optionsList = [
      [
        'Start Playing',
        'Add To Library',
        'Copy PlayList Link',
      ],
      [
        'Start Playing',
        'Add To Library',
        'Start Following',
        'Copy Artist Link',
      ],
    ];
    const optionList = optionsList[cardType];
    this.options = optionList;
  }
  get getCardId() {
    return this.card_id;
  }
  get getCardName() {
    return this.cardName;
  }
  get getCardUrl() {
    return this.cardUrl;
  }
  get getCardImage() {
    return this.cardImage;
  }
  get getDescription() {
    return this.description;
  }
  get getCardType() {
    return this.cardType;
  }
  get getOptions() {
    return this.options;
  }
  commandAudioController(command) {
    const commands = {
      play: () => {
        // TODO : play using audicontroller
        Audiocontroller.execute();
      },
      pause: () => {
        // TODO : pause using audioController
        Audiocontroller.execute();
      },
    };
    commands[command]();
  }
  commandQueue() {
    const queueCommands = commandMusicController.queueController().commands;
    queueCommands.queueInit([], this.getCardType, this.cardName, this.getCardImage);
  }
  getCardDOM() {
    function setAttributes(el, attrs) {
      if (typeof attrs !== 'undefined') {
        for (const key in attrs) {
          el.setAttribute(key, attrs[key]);
        }
      }
    };
    function app(el, ...args) {
      for (let index = 0; index < args.length; index++) {
        const element = args[index];
        el.appendChild(element);
      }
    };
    function cardPlayButtonClick(event, id) {
      event.preventDefault();
      event.stopPropagation();
      function cardPlay(data, status) {
        if (status === 'success') {
          const result = JSON.parse(JSON.parse(JSON.stringify(data)));
          console.log(result);
          const playlistInfo = result['playlist_info'][0];
          const queue = result['queue'];
          queueCommands.queueInit([], playlistInfo.playlist_type, playlistInfo.playlist_name, playlistInfo.playlist_photo_url);
          for (let index = 0; index < queue.length; index++) {
            const element = queue[index];
            const songsCommands = commandMusicController.songs().commands;
            const song = songsCommands.init(element.song_id, element.song_name, song_folder_path + element.song_src, image_folder_path + element.profile_pic, 0, element.artist, element.album_id, element.rating);
            queueCommands.addSong(song);
          }
          Audiocontroller.execute(0, 1);
        }
      };
      callController.callAjax('POST', { playlist_id: id }, './getQueue.php', {}, (data, status) => cardPlay(data, status));
    };
    const card = _$();
    card.className = 'card';
    const container = _$();
    container.className = 'container';
    const content = _$();
    content.className = 'content';
    // const a = _$('a');
    // setAttributes(a, { 'href': this.getCardUrl });
    const content_overlay = _$();
    content_overlay.className = 'content-overlay';
    const content_image = _$('img');
    content_image.className = 'content-image';
    setAttributes(content_image, { 'src': playlist_image_folder_path+this.cardImage, 'alt': this.cardName });
    const content_details = _$();
    content_details.className = 'content-details fadeIn-bottom';
    content_details.setAttribute('data-playlist-id', this.card_id);
    const card_music_controls_container = _$();
    card_music_controls_container.className = 'card-music-controls-container';
    const card_music_control_button_container1 = _$();
    const card_music_control_button_container2 = _$();
    const card_music_control_button_container3 = _$();

    card_music_control_button_container1.className = 'card-music-control-button-container card-favorite-button-container';
    card_music_control_button_container2.className = 'card-music-control-button-container card-play-button-container';
    const button = _$('button');
    const i = _$('i');
    i.className = 'material-icons-round svg-icon controller-icons';
    i.innerHTML = 'favorite';
    card_music_control_button_container3.className = 'card-music-control-button-container menu        card-more-button-container';
    const button1 = _$('button');
    button1.className = 'card-play-button';
    const button2 = _$('button');
    const i1 = _$('i');
    i1.className = 'material-icons-round svg-icon controller-icons';
    i1.innerHTML = 'play_arrow';
    const i2 = _$('i');
    i2.className = 'material-icons-round svg-icon controller-icons';
    i2.innerHTML = 'more_vert';
    const card_basic_data = _$();
    card_basic_data.className = 'card-basic-data';
    const a1 = _$('a');
    setAttributes(a1, { 'class': 'card-heading' });
    a1.innerText = this.getCardName;
    button.appendChild(i);
    button1.appendChild(i1);
    button2.appendChild(i2);
    button1.addEventListener('click', (event) => cardPlayButtonClick(event, this.getCardId));
    // app(card_music_control_button_container1, button);
    app(card_music_control_button_container2, button1);
    // app(card_music_control_button_container3, button2);
    app(card_music_controls_container, card_music_control_button_container2);
    app(content_details, card_music_controls_container);
    app(content, content_overlay, content_image, content_details);
    app(container, content);
    app(card_basic_data, a1);
    if (this.getCardType === 0) {
      const a2 = _$('a');
      a2.className = 'card-subHeading';
      a2.innerText = this.getDescription;
      app(card_basic_data, a2);
    }
    app(card, container, card_basic_data);

    return card;
  }
}
class CardsList {
  constructor(cards, title, description) {
    this.cardList = cards;
    this.title = title;
    this.description = description;
  }
  get getList() {
    return this.cardList;
  }
  get getlength() {
    return this.list.length;
  }
  get getTitle() {
    return this.title;
  }
  get getDescription() {
    return this.description;
  }
  getCard(id = 0) {
    this.cardList[id];
  }
  addCard(card) {
    this.cardList.push(card);
  }
  getCardListDOM() {
    function setAttributes(el, attrs) {
      if (typeof attrs !== 'undefined') {
        for (const key in attrs) {
          if (key === 'innertext') {
            el.innerHTML = attrs[key];
          } else {
            if (Object.prototype.hasOwnProperty.call(attrs, key)) {
              el.setAttribute(key, attrs[key]);
            }
          }
        }
      }
      return el;
    };
    function app(el, ...args) {
      for (let index = 0; index < args.length; index++) {
        const element = args[index];
        el.appendChild(element);
      }
      return el;
    };
    const section = setAttributes(_$('section'), { 'class': 'section' });
    const sectionTitle = setAttributes(_$(), { 'class': 'section-title' });

    const h2 = _$('h2');
    h2.innerText = this.getTitle;
    sectionTitle.appendChild(h2);
    const sectionCardListHolder = _$();
    sectionCardListHolder.className = 'section-card-list-holder';
    const leftArrowButtonContainer = _$();
    const leftArrowButton = _$('button');
    const leftArrowButtonIcon = _$('i');
    leftArrowButtonIcon.className = 'material-icons';
    leftArrowButtonIcon.innerHTML = 'keyboard_arrow_left';
    leftArrowButton.className = 'left-arrow-button';
    const sectionStageOuter = _$();
    const sectionStages = _$('ul');
    const rightArrowButtonContainer = _$();
    const rightArrowButton = _$('button');
    const rightArrowButtonIcon = _$('i');
    const t1 = app(setAttributes(leftArrowButtonContainer, { 'class': 'left-arrow-button-container' }), app(leftArrowButton, leftArrowButtonIcon));
    const t2 = app(setAttributes(rightArrowButtonContainer,
      {
        'class': 'right-arrow-button-container',
      }),
      app(setAttributes(rightArrowButton, {
        'class': 'right-arrow-button',
      }),
        setAttributes(rightArrowButtonIcon, { 'class': 'material-icons', 'innertext': 'keyboard_arrow_right' }))
    );
    const t3 = app(setAttributes(sectionStageOuter, {
      'class': 'section-stage-outer',
    }),
      setAttributes(sectionStages, { 'class': 'section-stage' }));
    const t4 = app(sectionCardListHolder, leftArrowButtonContainer, sectionStageOuter, rightArrowButtonContainer);
    const t5 = app(section, sectionTitle, sectionCardListHolder);
    const cardList = this.getList.cards;
    cardList && cardList.map((card, index) => {
      // playlist_description: "BlurryFace"
      // playlist_id: "1"
      // playlist_name: "BlurryFace"
      // playlist_photo_url: "image/song.jpg"
      // playlist_type: "1"
      const cardInstance = new Card(card.playlist_id, card.playlist_name, card.playlist_url, card.playlist_photo_url, card.playlist_description, card.playlist_type);
      const cardDom = cardInstance.getCardDOM();
      app(sectionStages, cardDom);
    });
    return section;
  }
}
const cardList = {
  'cards': [{
    'cardName': 'Title',
    'cardUrl': '#',
    'cardImage': 'image/song.jpg',
    'cardDescription': 'hello',
    'cardType': 0,
  },
  {
    'cardName': 'Title',
    'cardUrl': '#',
    'cardImage': 'image/song.jpg',
    'cardDescription': 'hello',
    'cardType': 0,
  },
  ],
};

function _(id = '', scope = document) {
  if (id.slice(0, 1) === '#') {
    return scope.getElementById(id.slice(1));
  } else if (id.slice(0, 1) === '.') {
    return scope.getElementsByClassName(id.slice(1));
  } else {
    return scope.querySelectorAll(id);
  }
}
function _$(node = 'div') {
  return document.createElement(node);
}
const Audiocontroller = (function () {
  let currentCard;
  let audioContext;
  let audioTrack;
  let audioTrackSliderHandle;
  let typeEvent = 0;
  const audioPlayForPublishers = [false, 0];
  const publisherSubscriber = {};
  // queueCommands.init();
  changeSongUrl = (url = '') => {
    audioElement.src = url;
  };
  getAudioElementSrc = () => {
    return audioElement.src;
  };

  checkAudioElement = () => {
    const check = (typeof audioElement !== 'undefined') && getAudioElementSrc() !== '';
    return check;
  };
  play = () => {
    const check = checkAudioElement();
    check && audioElement.play();
  };
  pause = () => {
    const check = checkAudioElement();
    check && audioElement.pause();
  };
  playNext = () => {
    const t = queueCommands.next();
    const song = queueCommands.play();
    showController1();
    return song;
  };
  playPrev = () => {
    const song = queueCommands.prev();
    return song;
  };
  showController1 = () => {
      const controller1 = _('.controller-1')[0];
      const img = _(' .song-image img', controller1)[0];
      const cardHeading = _(' .data .card-heading')[0];
      const cardSubHeading = _(' .data .card-subHeading')[0];
      const likeElement = _('#like');
    if (currentSong) {
      
      img.style.display='block';
      likeElement.style.display='block';
      img.src = currentSong.songImageUrl;
      cardHeading.innerText = currentSong.songName;
      cardSubHeading.innerText = currentSong.artists;
      likeElement.setAttribute('data-songid',currentSong.songId);
      if(currentSong.rating==1){
        likeElement.style.color='#ff1744';
      }
      else{
        likeElement.style.color='white';
      }
    } else {
      likeElement.style.display='none';
      img.style.display='none';
      cardHeading.innerText = '';
      cardSubHeading.innerText = '';
    }
  };
  let currentSong = queueCommands.play();
  const playButton = _('#play-button');

  const audioElement = document.querySelector('audio');
  changeSongUrl(currentSong.getSongAudioUrl);
  showController1();
  const audioTrackStartTime = document.getElementById('start-time');
  const audioTrackEndTime = document.getElementById('end-time');
  timeConversion = (sec) => {
    const time = Math.trunc(parseInt(sec));
    const tempTimeMinutes = Math.trunc(time / 60);
    const tempTimeSeconds = time % 60;
    return `${tempTimeMinutes}:${tempTimeSeconds.toString().padStart(2, '0')}`;
  };

  function setVolume(value) {
    audioElement.volume = value;
  }
  setAudioTrackPeek = (value) => {
    audioElement.currentTime = audioElement.duration * value;
  };
  $('#volume').slider({
    min: 0,
    max: 100,
    value: 100,
    range: 'min',
    slide: (event, ui) => setVolume(ui.value / 100),
  });
  $('#time-progress-bar').slider({
    min: 0,
    max: 100,
    value: 0,
    range: 'min',
    slide: (event, ui) => setAudioTrackPeek(ui.value / 100),
  });
  initializedAudio = () => {
    const AudioContext = window.AudioContext || window.webkitAudioContext;

    audioContext = new AudioContext();

    const track = audioContext.createMediaElementSource(audioElement);
    track.connect(audioContext.destination);

    audioTrack = document.querySelector('#time-progress-bar .ui-slider-range-min');
    audioTrackSliderHandle = document.querySelector('#time-progress-bar .ui-slider-handle');
  };
  (function () {
    audioElement.addEventListener('playing', (event) => {
      console.log('Video is no longer paused');
      publisherSubscriber.publish('audioPlaying', audioPlayForPublishers);
      setAudioTrack(true);
    });
    audioElement.addEventListener('pause', (event) => {
      console.log('The Boolean paused property is now true. Either the ' + 'pause() method was called or the autoplay attribute was toggled.');
      publisherSubscriber.publish('audioPlaying', audioPlayForPublishers);
      setAudioTrack(false);
    });
    audioElement.addEventListener('waiting', (event) => {
      console.log('Video is waiting for more data.');
    });
    audioElement.addEventListener('ended', (event) => {
      console.log('Video stopped either because 1) it was over, ' +
        'or 2) no further data is available.');

      const checkNext = queueCommands.checkNext();
      if (checkNext) {
        playNext();
        audioPlay();
      }
    });
    audioElement.addEventListener('loadeddata', (event) => {
      console.log('Yay! The readyState just increased to  ' + 'HAVE_CURRENT_DATA or greater for the first time.');
    });
    audioElement.addEventListener('canplay', (event) => {
      console.log('Video can start, but not sure it will play through.');
    });
    audioElement.addEventListener('canplaythrough', (event) => {
      console.log('I think I can play through the entire ' + 'video without ever having to stop to buffer.');
    });
    audioElement.addEventListener('ratechange', (event) => {
      console.log('The playback rate changed.');
    });
    audioElement.addEventListener('emptied', (event) => {
      console.log('Uh oh. The media is empty. Did you call load()?');
    });
    audioElement.addEventListener('stalled', (event) => {
      console.log('Failed to fetch data, but trying.');
    });
    audioElement.addEventListener('durationchange', (event) => {
      audioTrackEndTime.innerHTML = timeConversion(audioElement.duration);
    });
  })();

  startAudio = () => {
    touchStarted = () => {
      if (typeof audioContext === 'undefined') {
        initializedAudio();
      }
      // check if context is in suspended state (autoplay policy)
      if (audioContext.state === 'suspended') {
        audioContext.resume();
      }
    };
    touchStarted();
  };
  setAudioTrack = (playing) => {
    const handle = playing && setInterval(() => {
      audioTrackStartTime.innerText = timeConversion(audioElement.currentTime);
      const timePercentage = (audioElement.currentTime / audioElement.duration) * 100 + '%';
      audioTrack.style.width = timePercentage;
      audioTrackSliderHandle.style.left = timePercentage;
    }, 1000);
    !playing && clearInterval(handle);
  };
  // send in a container object which will handle the subscriptions and publishings
  (function (container) {
    // the id represents a unique subscription id to a topic
    let id = 0;

    // subscribe to a specific topic by sending in
    // a callback function to be executed on event firing
    container.subscribe = function (topic, f) {
      if (!(topic in container)) {
        container[topic] = [];
      }

      container[topic].push({
        'id': ++id,
        'callback': f,
      });

      return id;
    };

    // each subscription has its own unique ID, which is use
    // to remove a subscriber from a certain topic
    container.unsubscribe = function (topic, id) {
      const subscribers = [];
      for (const subscriber of container[topic]) {
        if (subscriber.id !== id) {
          subscribers.push(subscriber);
        }
      }
      container[topic] = subscribers;
    };

    container.publish = function (topic, data) {
      for (const subscriber of container[topic]) {
        subscriber.callback(data);
      }
    };
  })(publisherSubscriber);
  changeIconPlay = (data) => {

  };
  const subscribionId1 = publisherSubscriber.subscribe('audioPlaying', (data) => {
    if (data[0]) {
      playButton.dataset.playing = 'true';
      playButton.innerHTML = 'pause';
    } else {
      playButton.dataset.playing = 'false';
      playButton.innerHTML = 'play_arrow';
    }
  });
  const subscribionId2 = publisherSubscriber.subscribe('audioPlaying', (data) => {
    console.log('this is for card');
    if (data[1] == 1) {

    }
  });
  const subscribionId3 = publisherSubscriber.subscribe('audioPlaying', (data) => {
    console.log('this is for queue');
  });
  changeCard = (element) => {
    currentCard = element;
  };
  audioPlay = (id = 0, type = 0) => {
    audioPlayForPublishers[1] = typeEvent;
    startAudio();
    let song;
    switch (id) {
      case 0:
        song = queueCommands.play();
        break;
      case 1:
        pause();
        song=playNext();
        break;
      case 2:
        pause();
        song = playPrev();
        break;
      default: break;
    }
    const checkNext = queueCommands.checkNext();
    const nextButton = _('#next-button');
    nextButton.disabled = !checkNext;
    if (typeof song !== 'undefined') {
      if (currentSong.songAudioUrl !== song.songAudioUrl) {
        currentSong = song;
        changeSongUrl(currentSong.songAudioUrl);
        showController1();
      }
      const pauseCheck = audioElement.paused;
      typeEvent = type;
      audioPlayForPublishers[0] = pauseCheck;
      audioPlayForPublishers[1] = typeEvent;
      (pauseCheck) ? play() : pause();
      return true;
    } else {
      return false;
    }
  };

  return {
    execute: (id) => audioPlay(id),
  };
})();

const callController = {
  callAjax: function (type = 'POST', data = {}, url = '', dataType = {}, callBack) {
    $.ajax({
      type: type,
      data: data,
      url: url,
      success: (output, status) => {
        callBack(output, status);
      },
    });
  },
};

const mainHome = _('#main-home');
changeHome = (data, status) => {
  const results = JSON.parse(JSON.parse(JSON.stringify(data)));
  console.log(results);
  results.map((result)=>{
  const cardsList = new CardsList(result, result.info.title, 'dkdjs');
  const cardsListDom = cardsList.getCardListDOM();
  console.log(cardsListDom);
  mainHome.appendChild(cardsListDom);
  });
  uIHandler();
};
callController.callAjax('GET', {}, './getHomeData.php', {}, (data, status) => changeHome(data, status));
const uIHandler = () => {
  const playButton = _('#play-button');
  const shuffleButton = _('#shuffleButton');
  const prevButton = _('#prev-button');
  const nextButton = _('#next-button');
  const repeatButton = _('#repeat-button');
  const headerSearchInput = _('#header-search-input');
  const headerSearchForm = _('#header-search-form');
  const searchForm = _('#search-form');
  const searchFormContainer = _('.search-form-container')[0];
  const searchContainer = _(' #menu-after-login li')[0];
  const mainBackIcon = _('#main-back-icon');
  const searchBlockText = _('#search-block-text');
  const menus = _('.menu');
  const optionsMenu = _('#options-menu');
  const searchHintInput = _('#input-search-hint');
  const sectionStages = _('.section-stage');
  const leftArrowButtons = _('.left-arrow-button');
  const rightArrowButtons = _('.right-arrow-button');
  const cardListHolders = _('.section-card-list-holder');
  const cardPlayButtons = _('.card-play-button');
  const contentDetails = _('.content-details');
  const mainHomeHolder = _('#main-home-holder');
  const like = _("#like");
  const playListControllerButton = _('#playlist_controller_button');
  const picPlayButtons=_('.cover-card-song-item-image-container-overlay-button');
  const playBtn=_('#cover-play-button');
  prevButtonClick = (event) => {
    const disable = prevButton.disabled;
    const check = Audiocontroller.execute(2);
    // if (!disable) {
    //   prevButton.disabled = false;
    // }
  };
  playButtonClick = () => {
    playButton.disabled = true;
    const check = Audiocontroller.execute();
    playButton.disabled = false;
    // const playButtonI = playButton.querySelector('i');
    // playButtonI.innerHTML = 'play_circle_outline';
  };
  shuffleButtonClick = () => {
    Audiocontroller.execute();
    queueCommands.shuffle();
    Audiocontroller.execute();
    shuffleButton.disabled = true;
    setTimeout(function () {
      shuffleButton.disabled = false;
    }, 1000);
  };
  nextButtonClick = () => {
    const disable = nextButton.disabled;
    nextButton.disabled = true;
    const check = Audiocontroller.execute(1);
    if (!disable) {
      nextButton.disabled = false;
    }
  };
  repeatButtonClick = () => {
    const repeatType = queueCommands.repeatSong();
    if (repeatType > 0) {
      playButton.disabled = false;
      if (repeatType == 2) {
        repeatButton.innerText = 'repeat_one';
      }
    }
    switch (repeatType) {
      case 0:
        playButton.disabled = true;
        repeatButton.innerText = 'repeat';
        repeatButton.title = 'repeat off';
        break;
      case 1:
        playButton.disabled = false;
        repeatButton.innerText = 'repeat';
        repeatButton.title = 'repeat all';
        break;
      case 2:
        playButton.disabled = false;
        repeatButton.innerText = 'repeat_one';
        repeatButton.title = 'repeat one';
        break;
    }
  };
  addCoverPlaylistSongs = (data) => {
          const result = JSON.parse(JSON.parse(JSON.stringify(data)));
          console.log(result);
          const playlistInfo = result['playlist_info'][0];
          const queue = result['queue'];
          queueCommands.queueInit([], playlistInfo.playlist_type, playlistInfo.playlist_name, playlistInfo.playlist_photo_url);
          for (let index = 0; index < queue.length; index++) {
            const element = queue[index];
            const songsCommands = commandMusicController.songs().commands;
            const song = songsCommands.init(element.song_id, element.song_name, song_folder_path + element.song_src, image_folder_path + element.profile_pic, 0, element.artist, 'as', element.rating);
            queueCommands.addSong(song);
          }
  };
  playBtnClick = (event, type) => {
    const playBtn = event.currentTarget;
    const coverPage = _('#cover-page');
    const id = parseInt(coverPage.dataset.coverplaylistid);
    function cardPlay(data, status) {
        if (status === 'success') {
          addCoverPlaylistSongs = (data) => {
          const result = JSON.parse(JSON.parse(JSON.stringify(data)));
          console.log(result);
          const playlistInfo = result['playlist_info'][0];
          const queue = result['queue'];
          queueCommands.queueInit([], playlistInfo.playlist_type, playlistInfo.playlist_name, playlistInfo.playlist_photo_url);
          for (let index = 0; index < queue.length; index++) {
            const element = queue[index];
            const songsCommands = commandMusicController.songs().commands;
            const song = songsCommands.init(element.song_id, element.song_name, song_folder_path + element.song_src, image_folder_path + element.profile_pic, 0, element.artist, 'as', element.rating);
            queueCommands.addSong(song);
          }
          };
          addCoverPlaylistSongs(data);
          if(type==2){
            queueCommands.shuffle();
          }
          Audiocontroller.execute(0, 1);
        }
      };
      callController.callAjax('POST', { playlist_id: id }, './getQueue.php', {}, (data, status) => cardPlay(data, status));
    // const playButtonI = playButton.querySelector('i');
    // playButtonI.innerHTML = 'play_circle_outline';
  };

  // for (let index = 0; index < cardPlayButtons.length; index++) {
  //   const element = cardPlayButtons[index];
  //   element.addEventListener('click', (event) => cardPlayButtonClick(event));
  // }
  likeButtonClick = (event) => {
    afterLikeButtonClick=(data,status)=>{
if(status==='success'){
  if(data==1){
   likeElement.style.color='#ff1744';  
   likeElement.dataset.like='true';  
  }
  else{
    likeElement.style.color='white';
   likeElement.dataset.like='false'; 
  }
}
    };
    const likeElement = event.currentTarget;
    const dataLike = likeElement.dataset.like;
      callController.callAjax('POST',{liked:dataLike, song_id:likeElement.dataset.songid},'like.php',{},(data,status)=>afterLikeButtonClick(data, status));
    };
  searchAfterDataRetrieval = (data, value) => {
    const filterList = data['searchItems'];
    const dropDown = document.getElementsByClassName('dropdown-menu')[0];

    dropDown.style.display = 'block';
    for (; dropDown.childElementCount > 0;) {
      dropDown.removeChild(dropDown.lastElementChild);
    }
    const filterListCheck = filterList && filterList.length != 0;
    if (filterListCheck) {
      filterList.map((itemValue) => {
        const name = itemValue.song_name;
        const patternString = new RegExp(`${value}`, 'igm');
        const div = document.createElement('div');
        const a = document.createElement('a');
        const img = document.createElement('img');
        const span = document.createElement('span');
        div.className = 'dataset';
        a.className = 'dropdown-item dropdown-suggestion';
        a.href = song_folder_path + itemValue['song_src'];
        img.src = image_folder_path + itemValue['profile_pic'];
        img.alt = itemValue['name'];
        let tempStartIndex = 0;
        while ((match = patternString.exec(name))) {
          const startIndex = match.index;
          const endIndex = patternString.lastIndex;
          console.log(startIndex + ' ' + endIndex);
          const strong = document.createElement('strong');
          strong.innerHTML = value;
          span.appendChild(document.createTextNode(name.substring(tempStartIndex, startIndex)));
          span.appendChild(strong);
          tempStartIndex = endIndex;
        }
        span.appendChild(document.createTextNode(name.substring(tempStartIndex, name.length)));
        a.appendChild(img);
        a.appendChild(span);
        div.appendChild(a);
        dropDown.appendChild(div);
      });
    }
  };
  searchInputKeyUp = (event) => {
    event.preventDefault();

    const dropDown = document.getElementsByClassName('dropdown-menu')[0];
    const keyDownArrow = 40;
    let previousKey;
    const countKeyDown = 0;
    isPreviousKeyDownArrow = () => {
      return previousKey === keyDownArrow;
    };
    isKeyDownArrow = () => {
      return event.keyCode == keyDownArrow;
    };
    if (!isKeyDownArrow()) {
      const value = event.currentTarget.value.trim();
      const conditionValue = value != undefined && value != null && value != '';
      if (conditionValue) {
        callController.callAjax('POST', { searchInput: value }, '../rhythm/databaseTasks/search.php', {},
          (data, status) => {
            if (status === 'success') {
              const jsonData = JSON.parse(JSON.parse(JSON.stringify(data)));
              console.log(jsonData);
              searchAfterDataRetrieval(jsonData, value);
            }
          });
      } else {
        dropDown.style.display = 'none';
      }
    }
  };
  menuClick = (event) => {
    event.preventDefault();
    event.stopPropagation();
    const x = event.x;
    const y = event.y;
    const element = event.currentTarget;
    const elementWH = {
      w: element.clientWidth,
      h: element.clientHeight,
    };
    getPositionXY = (element) => {
      const rect = element.getBoundingClientRect();

      console.log('X: ' + rect.x + ', ' + 'Y: ' + rect.y);
      return {
        x: rect.x,
        y: rect.y,
      };
    };
    const elementXY = getPositionXY(element);
    const windowWH = {
      w: window.innerWidth,
      h: window.innerHeight,
    };
    const w = window.innerWidth;
    const h = window.innerHeight;
    console.log('w=' + w + '\th=' + h + '\tx=' + x + '\ty=' + y);
    const pad = 2;
    const widthSubMenu = 200;
    const heightSubMenu = 152;
    const sx = (elementXY.x + elementWH.w + widthSubMenu + pad) > windowWH.w ? (elementXY.x - widthSubMenu - pad + elementWH.w) : (elementXY.x + elementWH.w + pad);
    const sy = (elementXY.y + elementWH.h + heightSubMenu + pad) > windowWH.h ? (elementXY.y - heightSubMenu - pad) : (elementXY.y + elementWH.h + pad);
    optionsMenu.style.display = 'block';
    optionsMenu.style.top = `${sy}px`;
    optionsMenu.style.left = `${sx}px`;
  };
  searchContainerClick = () => {
    searchFormContainer.classList.remove('close-search');
    searchFormContainer.style.display = 'block';
    searchFormContainer.classList.add('open-search');
    searchBlockText.classList.remove('close-search-text');
    searchBlockText.classList.add('open-search-text');
  };
  mainBackIconClick = () => {
    searchBlockText.classList.remove('open-search-text');
    searchFormContainer.classList.remove('open-search');
    searchFormContainer.classList.add('close-search');
    searchBlockText.classList.remove('open-search-text');
    searchBlockText.classList.add('close-search-text');
    // searchFormContainer.style.display = 'none';
  };
  showPlayList = (event) => {
    event.preventDefault();
    showPlay = (data,status)=>{
      
      if(status=='success'){
        console.log(data);
        let coverPage = _('#cover-page');
        if (coverPage) {
          coverPage.parentNode.removeChild(coverPage);
        }
        const node=jQuery.parseHTML(data);
        mainHomeHolder.appendChild(node[0]);
        coverPage = _('#cover-page');
        const playBtn = _("#cover-play-button");
        const shuffleBtn = _('#cover-shuffle-button');
        playBtn.addEventListener('click', (event) => playBtnClick(event, 1));
        shuffleBtn.addEventListener('click', (event) => playBtnClick(event, 2));
        playListControllerButton.dataset.open='true';
        
        coverPage.classList.remove('close-cover-page');
        coverPage.classList.add('open-cover-page');
        const AC = Audiocontroller;
        picPlayButtonClick = (event, playListId) => {
          const element = event.currentTarget;
          const songId = element.dataset.coversongid;
          const currentSong = queueCommands.play();
          if(currentSong){
              if(currentSong.album==playListId){
                queueCommands.setSong(parseInt(songId));
                AC.execute();
              } else {
                    function picPlay(data, status) {
                      if (status === 'success') {
                        const result = JSON.parse(JSON.parse(JSON.stringify(data)));
                        console.log(result);
                        const playlistInfo = result['playlist_info'][0];
                        const queue = result['queue'];
                        queueCommands.queueInit([], playlistInfo.playlist_type, playlistInfo.playlist_name, playlistInfo.playlist_photo_url);
                        for (let index = 0; index < queue.length; index++) {
                          const element = queue[index];
                          const songsCommands = commandMusicController.songs().commands;
                          const song = songsCommands.init(element.song_id, element.song_name, song_folder_path + element.song_src, image_folder_path + element.profile_pic, 0, element.artist, element.album_id, element.rating);
                          queueCommands.addSong(song);
                        }
                        queueCommands.setSong(parseInt(songId));
                        AC.execute();
                      }
                };
                callController.callAjax('POST', { playlist_id: playListId }, './getQueue.php', {}, (data, status) => picPlay(data, status));
              }
          }

        }
        // const downloadButton=_('.downloadButton');
        // for (let index = 0; index < picPlayButtons.length; index++) {
        //   const element = picPlayButtons[index];
        //   element.addEventListener('click',(event)=>downloaPlayButtonClick(event,playListId));
        // }
        const picPlayButtons=_('.cover-card-song-item-image-container-overlay-button');
        for (let index = 0; index < picPlayButtons.length; index++) {
          const element = picPlayButtons[index];
          element.addEventListener('click',(event)=>picPlayButtonClick(event,playListId));
        }
      }
    };
    const element = event.currentTarget;
    const playListId = element.getAttribute('data-playlist-id');
    console.log(playListId);
    callController.callAjax('POST', { playlist_id: playListId }, './playlist.php', {}, (data, status) => showPlay(data, status));
    event.stopPropagation();
  }

  playListControllerButtonClick = (event)=>{
    const element= event.currentTarget;
    const coverPage = _('#cover-page');
    if(element.dataset.open=='false'){
      element.dataset.open='true';
      if(coverPage){
        coverPage.classList.add('open-cover-page');
        coverPage.classList.remove('close-cover-page');
      }
      
    } else{
      element.dataset.open='false';
      if(coverPage){
        coverPage.classList.add('close-cover-page');
        coverPage.classList.remove('open-cover-page');
      }
    }
  };

  playButton.addEventListener('click', (event) => playButtonClick());
  shuffleButton.addEventListener('click', (event) => shuffleButtonClick());
  nextButton.addEventListener('click', (event) => nextButtonClick());
  repeatButton.addEventListener('click', (event) => repeatButtonClick());
  headerSearchInput.addEventListener('keyup', (event) => searchInputKeyUp(event));
  searchContainer.addEventListener('click', (event) => searchContainerClick());
  mainBackIcon.addEventListener('click', (event) => mainBackIconClick());
  prevButton.addEventListener('click', (event) => prevButtonClick());
  like.addEventListener('click', (event) => likeButtonClick(event));
  playListControllerButton.addEventListener('click',(event)=> playListControllerButtonClick(event));
  for (let i = 0; i < contentDetails.length; i++){
    const element = contentDetails[i];
    element.addEventListener('click', (event)=>showPlayList(event));
  }
  document.addEventListener('click', () => {
    if (optionsMenu.style.display == 'block') {
      optionsMenu.style.display = 'none';
    }
  });
  for (let index = 0; index < menus.length; index++) {
    const element = menus[index];
    element.addEventListener('click', (event) => menuClick(event));
  }
  //  TODO : ripple effect
  for (let index = 0; index < sectionStages.length; index++) {
    const leftArrowButton = leftArrowButtons[index];
    const rightArrowButton = rightArrowButtons[index];
    const sectionStage = sectionStages[index];
    const cardListHolder = cardListHolders[index];
    const cardWidth = 180 + 32;
    const width = cardWidth * sectionStage.childElementCount;
    const curvePoints = [0.4, 0.0, 0.2, 1];
    console.log(width);
    slide = (event, sign = 1, sectionStage) => {
      event.preventDefault();
      const scroll = sectionStage.scrollLeft;
      if (sign == -1) {
        animationRemoveSetInterval('leftArrowButtonAnimation');
        setAnimation('leftArrowButtonAnimation', sectionStage, 'srollLeft', 0.25, curvePoints, scroll, -400);
      } else {
        animationRemoveSetInterval('rightArrowButtonAnimation');
        setAnimation('rightArrowButtonAnimation', sectionStage, 'srollLeft', 0.25, curvePoints, scroll, 400);
      }
      event.stopPropagation();
    };
    leftArrowButton.addEventListener('click', (event) => slide(event, -1, sectionStage));
    rightArrowButton.addEventListener('click', (event) => slide(event, 1, sectionStage));
  }

  const elementListForAnimation = [];
  setAnimation = (name = '', element, property = '', time = 0, curvePoints = [1, 1, 1, 1], start, end) => {
    const animationTime = time * 10;
    const xArray = [0];
    const yArray = [0];

    calculateCordinate = (p1, p2, t) => {
      const complementTime = 1 - t;
      const c = (complementTime * complementTime * t * p1 * 3) + (3 * complementTime * t * t * p2) + (t * t * t);
      return c;
    };
    elementListForAnimation[name] = [];
    for (let index = 1; index < 101; index++) {
      const currentTime = index * 0.01;
      const x = calculateCordinate(curvePoints[0], curvePoints[2], currentTime);
      const y = calculateCordinate(curvePoints[1], curvePoints[3], currentTime);
      xArray.push(x);
      yArray.push(y);
    }
    elementListForAnimation[name].push({
      'x': xArray,
      'y': yArray,
      'start': start,
      'end': end,
      'times': 1,
      'element': element,
      'property': property,
      'handler': 0,
      'clearInterval': (name) => animationRemoveSetInterval(name),
    });


    const handler = setInterval((listArray, name) => {
      const list = listArray[0];
      const time = list.times;
      const tempx = list.x[time] - list.x[time - 1];
      const tempy = list.y[time] - list.y[time - 1];
      const slopeSign = (tempy / tempx) < 0 ? -1 : 1;
      const element = list.element;
      const start = list.start;
      const end = list.end;
      const temp = start + (slopeSign * list.y[time] * end);
      element.scrollLeft = temp;
      elementListForAnimation[name][0].times = time + 1;
      if (time == 100) {
        clearInterval(handler);
        elementListForAnimation[name] = [];
      }
    }, animationTime, elementListForAnimation[name], name);
    elementListForAnimation[name][0].handler = handler;
  };
  animationRemoveSetInterval = (name = '') => {
    if (elementListForAnimation[name] && elementListForAnimation[name][0] && elementListForAnimation[name][0].handler) {
      clearInterval(elementListForAnimation[name][0].handler);
    }
    elementListForAnimation[name] = [];
  };
};

// console.log(c.commandAudioController('play'));
