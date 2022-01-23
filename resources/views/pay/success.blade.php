@extends('layouts.app')

@section('content')

<!-- 支付成功 -->
<div class="bg-white flex flex-center margin103">
  <img src="/img/success-pay.png" alt="支付成功">
  <h3>支付成功</h3>
  <p>恭喜您，已众筹成功～</p>
  <a class="el-button el-button--primary is-plain" href="{{ $redirectUrl }}">继续逛逛</a>
</div>
@endsection
<style lang="css"  scoped>
  .margin103{
    flex-direction: column;
    width: 660px;
    padding:50px 0;
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
    margin-bottom:36px;
  }
  .el-button{
    min-width:150px;
  }
  @media  screen and (max-width: 665px){
    .margin103{
      margin: 5% auto;
      width:98%;
    }
  }
</style>
