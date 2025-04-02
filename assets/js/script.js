document.addEventListener('DOMContentLoaded', function() {
    const audioPlayer = document.getElementById('audioPlayer');
    const playPauseBtn = document.getElementById('playPauseBtn');
  
    // When the play/pause button is clicked
    playPauseBtn.addEventListener('click', function() {
      if (audioPlayer.paused) {
        audioPlayer.play();  // Play the audio if it's paused
        playPauseBtn.textContent = 'Pause Introduction';  // Change button text to Pause
        playPauseBtn.classList.add('pause'); // Add the pause class to the button for styling
      } else {
        audioPlayer.pause();  // Pause the audio if it's playing
        playPauseBtn.textContent = 'Play Introduction';  // Change button text to Play
        playPauseBtn.classList.remove('pause', 'Introduction'); // Remove the pause class to return to default styling
      }
    });
  
    // Optional: Change button text when the audio ends
    audioPlayer.addEventListener('ended', function() {
      playPauseBtn.textContent = 'Play Introduction';  // Reset button text to Play after the audio ends
      playPauseBtn.classList.remove('pause'); // Remove the pause styling
    });
  });
  