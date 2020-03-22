<style>
    /*   @keyframes fade {
           0%, 50% {
               opacity: 0;
               transform: scale(0);
           }
       }
       @keyframes dot-anim {
           0% {
               top: -4vw;
           }
           50% {
               top: 4vw;
           }
           100% {
               top: -4vw;
           }
       }
       @keyframes checked-radio-3 {
           0% {
               top: -10vw;
               transform: scale(0);
           }
           100% {
               top: 0;
               transform: scale(1);
           }
       }
       @keyframes unchecked-radio-3 {
           0% {
               bottom: 0;
               transform: scale(1);
           }
           100% {
               bottom: -10vw;
               transform: scale(0);
           }
       }
       @keyframes checked-radio-4 {
           0% {
               transform: rotate(0) translateY(-4.8vw) scale(.2);
           }
           83% {
               transform: rotate(360deg) translateY(-2.5vw) scale(1);
               transform-origin: 2vw;
           }
           88% {
               transform: translateY(.6vw) scale(1);
           }
           93% {
               transform: translateY(-.9vw) scale(1);
           }
           100% {
               transform: translateY(0) scale(1);
           }
       }
       @keyframes unchecked-radio-4 {
           25% {
               top: -6.5vw;
           }
           50% {
               top: 9vw;
           }
           75% {
               top: -10vw;
           }
           100% {
               top: -10vw;
               transform: scale(0);
           }
       }
       *, *:before, *:after {
           margin: auto;
           padding: 0;
           outline: 0;
           overflow: hidden;
           box-sizing: border-box;
       }
       html, body { background: white; }
       main, .container, label, label:before, label:after {
           position: absolute;
           top: 0;
           bottom: 0;
           left: 0;
           right: 0;
       }
       main {
           width: 95vw;
           height: 50vw;
       }
       .container {
           width: 100%;
           height: 100%;
           animation: fade 1s;
       }
       label {
           display: inline-block;
           width: 10vw;
           height: 10vw;
           border-radius: 50%;
           transition: all .2s ease-in-out;
           animation-timing-function: ease-in-out;
           animation-iteration-count: infinite;
           animation-duration: 1.6s;
           animation-name: dot-anim;
       }
       .radio:checked + label {
           animation-play-state: paused;
       }
       label:before {
           content: "";
           position: absolute;
           width: 5vw;
           height: 5vw;
           background: white;
           border-radius: 50%;
           box-shadow: rgba(0, 0, 0, 0.117647) 0 0 .8vw 0, rgba(0, 0, 0, 0.239216) 0 .8vw .8vw 0;
           transition: all .2s;
       }
       label:hover:before {
           box-shadow: rgba(0, 0, 0, 0.0784314) 0 0 1vw 0, rgba(0, 0, 0, 0.239216) 0 1vw 1vw 0;
       }
       label:after {
           content: "";
           position: absolute;
           width: 10vw;
           height: 10vw;
           background: rgba(255, 255, 255, .5);
           border-radius: 50%;
           transform: scale(0);
       }
       .radio:checked + label:after {
           background: transparent;
           transition: all .5s;
           transform: scale(1);
       }
       !**** BLUE Radio button code ****!
       #radio-1 + label {
           left: -60vw;
           background: #4285F4;
           animation-delay: 0s;
       }
       #radio-1 + label:before {
           transform: scale(0);
       }
       #radio-1:checked + label:before {
           transform: scale(1);
           transition: all .4s;
       }
       !**** RED radio button code ****!
       #radio-2 + label {
           left: -20vw;
           background: #EA4335;
           border-color: #EA4335!important;
           animation-delay: .2s;
       }
       #radio-2:checked + label {
           background: white;
           border: 1vw solid;
           box-shadow: inset rgba(0, 0, 0, 0.117647) 0 0 .6vw 0, inset rgba(0, 0, 0, 0.239216) 0 .6vw .8vw 0;
           transition: all .2s;
       }
       #radio-2:checked + label:before {
           width: 5vw;
           height: 5vw;
           background: #EA4335;
           transition: all .4s;
       }
       !* for IE *!
       #radio-2:not(:checked) + label:before {
           width: 8vw;
           height: 8vw;
           background: #EA4335;
           box-shadow: none;
       }
       !**** YELLOW radio button code ****!
       #radio-3 + label {
           left: 20vw;
           background: #FBBC05;
           animation-delay: .4s;
       }
       #radio-3 + label:before {
           !* background: #E91E63; *!
           transform: scale(0);
           animation-name: unchecked-radio-3;
           animation-duration: .2s;
           animation-timing-function: ease-in-out;
       }
       #radio-3:checked + label:before {
           animation-name: checked-radio-3;
           animation-duration: .4s;
           animation-timing-function: ease-in-out;
           animation-fill-mode: both;
       }
       !**** GREEN radio button code ****!
       #radio-4 + label {
           left: 60vw;
           background: #34A853;
           animation-delay: .6s;
       }
       #radio-4 + label:before {
           !* background: #8BC34A; *!
           animation: unchecked-radio-4 .5s both;
       }
       #radio-4:checked + label:before {
           animation-name: checked-radio-4;
           animation-duration: .6s;
           animation-timing-function: cubic-bezier(0.22, 0.61, 0.36, 1);
           animation-fill-mode: both;
       }
       [type="radio"] {
           display: none;
       }*/
</style>


<?php echo $this->Html->css(['css/sb-admin.min.css', 'css/all.min.css', 'bootstrap1.min']);

$this->fetch('css');

?>
<p style="font-size: x-large; color: #007ba4"><?php echo __('Nos contacts') ?></p>
<p style="font-size: large;"><?php echo __('Pour toute préoccupation ou suggestions, Nous sommes disponible à travers ces contacts:') ?></p>
<div><strong>WhatsApp:</strong> (00216)52-602-960</div>
<div></div>
<div><strong>Email:</strong><em> nombroni@gmail.com</em></div>
<div>Nous vous souhaitons un bon usage</div>
