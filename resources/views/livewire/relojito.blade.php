<div class="flex flex-col items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 100 100"
         width="{{ $size }}"
         height="{{ $size }}">
        <!-- Círculo exterior -->
        <circle cx="50" cy="50" r="48" stroke="currentColor" stroke-width="2" fill="none"/>
        <!-- Aguja de horas -->
        <line id="hour-hand" x1="50" y1="50" x2="50" y2="30" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
        <!-- Aguja de minutos -->
        <line id="minute-hand" x1="50" y1="50" x2="50" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        <!-- Aguja de segundos -->
        <line id="second-hand" x1="50" y1="50" x2="50" y2="15" stroke="currentColor" stroke-width="1" stroke-linecap="round"/>
    </svg>

    <script>
        const hourHand = document.getElementById('hour-hand');
        const minuteHand = document.getElementById('minute-hand');
        const secondHand = document.getElementById('second-hand');

        function updateClock() {
            const now = new Date();

            const hours = now.getHours() % 12;
            const minutes = now.getMinutes();
            const seconds = now.getSeconds() + now.getMilliseconds() / 1000;

            const hourAngle = (hours + minutes/60) * 30; // 360°/12 = 30° por hora
            const minuteAngle = (minutes + seconds/60) * 6; // 360°/60 = 6° por minuto
            const secondAngle = seconds * 6; // 360°/60 = 6° por segundo

            hourHand.setAttribute('transform', `rotate(${hourAngle} 50 50)`);
            minuteHand.setAttribute('transform', `rotate(${minuteAngle} 50 50)`);
            secondHand.setAttribute('transform', `rotate(${secondAngle} 50 50)`);

            requestAnimationFrame(updateClock);
        }

        updateClock();
    </script>
</div>
