window.onload = function () {
    $(document).ready(function () {
        let audioContext;
        let audioTrack, audioTrackSliderHandle;
        var data = {
            dataItems: [{
                'name': 'dhruv',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'ank',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'samp',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'dhrum',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'prag',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'smru',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'rishi',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'jain',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            {
                'name': 'ddevauv',
                'url': '#',
                'image-url': 'image/song.jpg',
            },
            ]
        };
        initializedAudio = () => {
            const AudioContext = window.AudioContext || window.webkitAudioContext;

            audioContext = new AudioContext();

            const track = audioContext.createMediaElementSource(audioElement);
            track.connect(audioContext.destination);

            audioTrack = document.querySelector('#time-progress-bar .ui-slider-range-min');
            audioTrackSliderHandle = document.querySelector('#time-progress-bar .ui-slider-handle');
        };
        timeConversion = (sec) => {
            const time = Math.trunc(parseInt(sec));
            const tempTimeMinutes = Math.trunc(time / 60);
            const tempTimeSeconds = time % 60;
            return `${tempTimeMinutes}:${tempTimeSeconds.toString().padStart(2, '0')}`;
        }
        const playButton = document.getElementById('play-button');

        const audioElement = document.querySelector('audio');
        const audioTrackStartTime = document.getElementById('start-time');
        const audioTrackEndTime = document.getElementById('end-time');
        const playButtonI = playButton.querySelector('i');
        playButton.addEventListener('click', function () {
            touchStarted();
            // play or pause track depending on state
            if (this.dataset.playing === 'false') {
                audioElement.play();
                this.dataset.playing = 'true';
                playButtonI.innerHTML = 'play_circle_outline';
            } else if (this.dataset.playing === 'true') {
                audioElement.pause();
                this.dataset.playing = 'false';
                playButtonI.innerHTML = 'pause_circle_outline';
            }
            setAudioTrack(this.dataset.playing);
            audioTrackEndTime.innerHTML = timeConversion(audioElement.duration);
        }, false);
        audioElement.addEventListener('ended', () => {
            playButton.dataset.playing = 'false';
        }, false);
        function touchStarted() {
            if (audioContext === undefined) {
                initializedAudio();
            }
            // check if context is in suspended state (autoplay policy)
            if (audioContext.state === 'suspended') {
                audioContext.resume();
            }
        }
        function setVolume(value) {
            audioElement.volume = value;
        }
        setAudioTrackPeek = (value) => {
            audioElement.currentTime = audioElement.duration * value;
        }
        $("#volume").slider({
            min: 0,
            max: 100,
            value: 100,
            range: "min",
            slide: (event, ui) => setVolume(ui.value / 100)
        });
        $("#time-progress-bar").slider({
            min: 0,
            max: 100,
            value: 0,
            range: "min",
            slide: (event, ui) => setAudioTrackPeek(ui.value / 100)
        });
        setAudioTrack = (playing) => {

            const handle = setInterval(() => {
                audioTrackStartTime.innerText = timeConversion(audioElement.currentTime);
                const timePercentage = ((audioElement.currentTime / audioElement.duration) * 100) + '%';
                audioTrack.style.width = timePercentage;
                audioTrackSliderHandle.style.left = timePercentage;
            }, 1000);
            !playing && clearInterval(handle);
        }
        $('#header-search-input').on(
            'keyup', (event) => {
                const value = event.currentTarget.value.trim();
                const conditionValue = value != undefined && value != null && value != '';
                const filterList = conditionValue && data.dataItems.filter((itemValue) => {
                    const name = itemValue.name;
                    const patternString = new RegExp(`${value}`, 'i');
                    return patternString.test(name);
                });
                // <div class="dataset">
                //                         <a href="#" class="dropdown-item dropdown-suggestion">
                //                             <img src="image/song.jpg" alt="suggestion-image" sizes="" srcset="" />
                //                             <span>ks</span>
                //                         </a>
                //                     </div>

                const dropDown = document.getElementsByClassName('dropdown-menu')[0];
                for (; dropDown.childElementCount > 0;) {
                    dropDown.removeChild(dropDown.lastElementChild);
                }
                const filterListCheck = filterList && filterList.length != 0;
                if (filterListCheck) {

                    dropDown.style.display = 'block';
                    filterList.map((itemValue) => {
                        const name = itemValue.name;
                        const patternString = new RegExp(`${value}`,'igm');
                        let div = document.createElement('div');
                        let a = document.createElement('a');
                        let img = document.createElement('img');
                        let span = document.createElement('span');
                        div.className = 'dataset';
                        a.className = 'dropdown-item dropdown-suggestion';
                        a.href = itemValue['url'];
                        img.src = itemValue['image-url'];
                        img.alt = itemValue['name'];
                        let tempStartIndex=0;
                        while (match = patternString.exec(name)) {
                            const startIndex = match.index;
                            const endIndex = patternString.lastIndex;
                            console.log( startIndex+ ' ' + endIndex);
                            const strong = document.createElement('strong');
                            strong.innerHTML = value;
                            span.appendChild(document.createTextNode(name.substring(tempStartIndex,startIndex)));
                            span.appendChild(strong);
                            tempStartIndex=endIndex;
                        }
                        span.appendChild(document.createTextNode(name.substring(tempStartIndex,name.length)));
                        a.appendChild(img);
                        a.appendChild(span);
                        div.appendChild(a);
                        dropDown.appendChild(div);
                    });
                }
                else {
                    dropDown.style.display = 'none';
                }

            }
        );
    });
}