
<div class="banner">

    <div class="banner__wraper">
        <div id="banner-slide" class="banner__wraper__slide flex" width="{@banners_amount}00%">
            {@banners}
        </div>
    </div>

    <script>
        const bannerSlide = document.getElementById('banner-slide');
        const slide = document.querySelectorAll('.banner__slide-box');
        const amountSlides = slide.length;
        var count = 0;
        var currentSlide;

        bannerSlide.style.width = bannerSlide.getAttribute('width');

        const startCurrentSlide = () => {
            currentSlide = setInterval( () => {
                count++;
                count = count == amountSlides ? 0 : count;
                
                let pixel = bannerSlide.children[0].clientWidth * count;
                let translate =  count ? `translateX(-${pixel}px)`: `translateX(0%)`;
                
                bannerSlide.style.transform = translate;
                bannerSlide.style.transition = `all 0.3s`;
                
            }, 5000);
        }

        const pauseCurrentSlide = () => {
            clearInterval(currentSlide);
            bannerSlide.style.cursor = 'grabbing';
        }

        const resumeCurrentSlide = () => {
            startCurrentSlide();
            bannerSlide.style.cursor = 'grab';

        }
      
        bannerSlide.addEventListener('mousedown', pauseCurrentSlide);
        bannerSlide.addEventListener('mouseup', resumeCurrentSlide);
            
        startCurrentSlide();
        
    </script>
</div>