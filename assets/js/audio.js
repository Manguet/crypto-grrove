$(document).ready(function () {
    let imgAudio = document.querySelector('#audio-play');

    if (imgAudio) {

        let sound = imgAudio.dataset.sound;
        let audio = new Audio('sounds/' + sound);

        audio.addEventListener("canplaythrough", event => {
            audio.play();
            audio.loop = true;
        })

        imgAudio.addEventListener("click", event => {
            if (isPlaying(audio)) {
                audio.pause();
            } else {
                audio.play();
                audio.loop = true;
            }

        })
    }
})

function isPlaying(audelem) {
    return !audelem.paused;
}