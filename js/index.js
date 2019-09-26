window.onload = function () {
    let audioContext;
    let audioTrack,audioTrackSliderHandle;
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
            playButtonI.innerHTML='play_circle_outline';
        } else if (this.dataset.playing === 'true') {
            audioElement.pause();
            this.dataset.playing = 'false';
            playButtonI.innerHTML='pause_circle_outline';
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
        audioElement.currentTime = audioElement.duration*value;
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
            const timePercentage =((audioElement.currentTime / audioElement.duration) * 100) + '%';
            audioTrack.style.width = timePercentage;
            audioTrackSliderHandle.style.left = timePercentage;
        }, 1000);
        !playing&&clearInterval(handle);
    }
    
}