@extends('layouts.app')

@section('content')
<!-- 支付失败 -->
<div class="bg-white flex flex-center margin103">
  <img src="/img/fail-pay.png" alt="支付失败">
  <h3>支付失败</h3>
  <p>很抱歉，可能网络迷失了，<span onclick="location.reload()">再试试吧~</span></p>
</div>

@endsection
<style lang="css"  scoped>
  .margin103{
    flex-direction: column;
    width: 660px;
    height: 290px;
    margin:103px auto;
    box-shadow: 0px 2px 4px 0px #E5E5E5;
  }
  .margin103 img{
      margin-bottom:30px;
  }
  h3{
    font-size: 22px;
    color: #222222;
    line-height: 22px;
    margin-bottom: 16px;
  }
  p{
    font-size: 16px;
    color: #666666;
    line-height: 16px;
  }
  @media  screen and (max-width: 665px){
    .margin103{
      margin: 5% auto;
      width:98%;
    }
  }
</style>
