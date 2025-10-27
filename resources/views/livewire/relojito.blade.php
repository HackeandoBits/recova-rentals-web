<div class="flex flex-col items-center justify-center">
  <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="80" height="80">
    <!-- Círculo exterior -->
    <circle cx="50" cy="50" r="48" stroke="currentColor" stroke-width="2" fill="none"/>
    <!-- Aguja -->
    <line id="hand" x1="50" y1="50" x2="50" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  </svg>

  <script>
    const hand = document.getElementById('hand');
    function updateClock() {
      const now = new Date();
      const seconds = now.getSeconds() + now.getMilliseconds() / 1000;
      const angle = seconds * 6; // 360° / 60s = 6° por segundo
      hand.setAttribute('transform', `rotate(${angle} 50 50)`);
      requestAnimationFrame(updateClock);
    }
    updateClock();
  </script>
</div>
