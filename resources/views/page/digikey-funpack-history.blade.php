<div class="bg-white">
    <div class="stepDiv">
        <h2>往期精彩</h2>
        <div class="phase4-slides phone-hidden">
            <a href="/page/digikey-funpack/phase{{ $index - 3 }}" target="_blank">
                <img class="front" src="/storage/page/digikey-funpack/image/phase{{ $index - 3 }}.png" alt="第{{ $index - 3 }}期">
            </a>
            <a href="/page/digikey-funpack/phase{{ $index - 2 }}" target="_blank">
                <img class="back" src="/storage/page/digikey-funpack/image/phase{{ $index - 2 }}.png" alt="第{{ $index - 2 }}期">
            </a>
            <a href="/page/digikey-funpack/phase{{ $index - 1 }}" target="_blank">
                <img class="active" src="/storage/page/digikey-funpack/image/phase{{ $index - 1 }}.png" alt="第{{ $index - 1 }}期">
            </a>
            <div class="btns">
                <span class="btn">&lt;</span>
                <span class="btn">&gt;</span>
            </div>
        </div>

        <div class="flex flex-between flex-wrap padding-20 last-phases phone-show text-center">
            <a href="/page/digikey-funpack/phase{{ $index - 1 }}" target="_blank">
                <img src="/storage/page/digikey-funpack/image/phase{{ $index - 1 }}.png">
            </a>
            <a href="/page/digikey-funpack/phase{{ $index - 2 }}" target="_blank">
                <img src="/storage/page/digikey-funpack/image/phase{{ $index - 2 }}.png">
            </a>
            <a href="/page/digikey-funpack/phase{{ $index - 3 }}" target="_blank">
                <img src="/storage/page/digikey-funpack/image/phase{{ $index - 3 }}.png">
            </a>
        </div>
        <a class="flex flex-center button-all" href="/page/digikey-funpack/list" target="_blank">
            <img src="/storage/page/digikey-funpack/image/5/button-all.png" alt="">
        </a>
        <div class="line-phone" class="phone-show"></div>
    </div>
</div>
<script>
onload = function(){
  var btns = document.getElementsByClassName('btn'),
  imgs = document.getElementsByClassName('phase4-slides')[0].getElementsByTagName('img');

  var index = 2,
  front = 0,
  back = 0,
  offset = false,
  timer = setInterval(timer,5000);

  for(var i=0;i<btns.length;i++){
    (function(i){
      btns[i].onclick = function(){click(i)};
    })(i);

    btns[i].onmouseover = function(){
      offset = true;
    }
    btns[i].onmouseout = function(){
      offset = false;
    }
  }

  for(var i=0;i<imgs.length;i++){
    imgs[i].onmouseover = function(){
      offset = true;
    }
    imgs[i].onmouseout = function(){
      offset = false;
    }
  }

  function timer(){
    if(offset){
      return;
    }
    else{
      click(1)
    }
  }

  function click(x){
    imgs[index].setAttribute('class','');
    if(x === 0){
      if(--index < 0){
      index = --imgs.length;
      }
      front = back = index;
      if(++front > --imgs.length){front = 0}
      if(--back < 0){back = --imgs.length}
      imgs[front].style.zIndex = '1';
      imgs[back].style.zIndex = '0';
    }else{
      if(++index > --imgs.length){
      index = 0;
      }
      front = back = index;
      if(++front > --imgs.length){front = 0}
      if(--back < 0){back = --imgs.length}
      imgs[front].style.zIndex = '0';
      imgs[back].style.zIndex = '1';
    }
    imgs[index].style.zIndex = '10';
    imgs[front].setAttribute('class','front')
    imgs[back].setAttribute('class','back')
    imgs[index].setAttribute('class','active');
  }
}
</script>
