<section class="delimiter mt-200">
    <div class="delimiter__wrapper">
        @for($i = 1; $i < 20; $i++ )
            <p class="running-text" id="running-line">
                <img src="{{ asset('front/icons/lotus-icon.png') }}" alt="lotus icon" width="25" height="26">
                <span>The Lotus</span>
            </p>
        @endfor
    </div>
</section>

{{--<script>--}}
{{--    window.onload = function() {--}}
{{--        const runningLine = document.getElementById('running-line');--}}
{{--        const screenWidth = window.innerWidth;--}}
{{--        const blockWidth = runningLine.offsetWidth;--}}
{{--        const speed = 10; // Adjust speed as needed (lower = faster)--}}

{{--        let position = 0;--}}
{{--        let currentBlock = 0;--}}

{{--        function moveBlock() {--}}
{{--            position += 1;--}}
{{--            runningLine.children[currentBlock].style.transform = `translateX(-${position}px)`;--}}

{{--            if (position > blockWidth) {--}}
{{--                runningLine.children[currentBlock].style.transform = `translateX(0)`;--}}
{{--                position = 0;--}}
{{--                currentBlock = (currentBlock + 1) % runningLine.children.length;--}}
{{--            }--}}

{{--            requestAnimationFrame(moveBlock);--}}
{{--        }--}}

{{--        moveBlock();--}}
{{--    }--}}
{{--</script>--}}
