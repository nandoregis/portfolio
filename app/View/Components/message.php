<div id="container-message" class="container-message {@status}">

    <div id='message-close' class='message__btn-close'>
        <svg width='12' height='12' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'>
            <mask id='mask0_998_7' style='mask-type:luminance' maskUnits='userSpaceOnUse' x='0' y='0' width='20' height='20'>
                <path d='M1.25 1.25H18.75V18.75H1.25V1.25Z' fill='white' stroke='white' stroke-width='2.5'/>
                </mask>
                <g mask='url(#mask0_998_7)'>
                <path d='M5.83325 5.83337L14.1666 14.1667ZM5.83325 14.1667L14.1666 5.83337Z' fill='#F9F9F9'/>
                <path d='M5.83325 5.83337L14.1666 14.1667M5.83325 14.1667L14.1666 5.83337' stroke='#F9F9F9' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
            </g>
        </svg>
    </div>

    <div id="box-message" class="box-message">
        <p>{@message}</p>
    </div>

    <script>
        const boxMessage = document.getElementById('message-close');
    
        boxMessage.addEventListener('click', () => {
            boxMessage.parentElement.remove();
        });
    </script>
</div>
