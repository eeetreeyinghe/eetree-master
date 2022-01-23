@extends('layouts.app')

@section('content')
<div class="bg-white flex flex-center margin103">
  <img src="/img/icons/wait.svg" alt="支付成功">
  <h3>等待支付</h3>
  <p>请在微信中完成付款～</p>
  <div>
    <a class="el-button el-button--primary is-plain" href="{{ $redirectUrl }}">取消支付</a>
    <a class="el-button el-button--warning is-plain" href="{{ $redirectUrl }}">完成付款</a>
  </div>
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
    margin-bottom: 36px;
  }
  .el-button{
    min-width: 150px;
  }
  @media  screen and (max-width: 665px){
    .margin103{
      margin: 5% auto;
      width:98%;
    }
  }
</style>
