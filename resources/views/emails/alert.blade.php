<style type="text/css">
.header {
  background: #8a8a8a;
}
.header .columns {
  padding-bottom: 0;
}
.header p {
  color: #fff;
  margin-bottom: 0;
}
.header .wrapper-inner {
  padding: 20px; /*controls the height of the header*/
}
.header .container {
  background: #8a8a8a;
}
.wrapper.secondary {
  background: #f3f3f3;
}
</style>
<!-- move the above styles into your custom stylesheet -->


<wrapper class="header" bgcolor="#8a8a8a">
  <container>
    <row class="collapse">
      <columns small="6" valign="middle">
        <p style="text-align:center">Black/White List</p>
      </columns>
    </row>
  </container>
</wrapper>

<container>

  <spacer size="16"></spacer>
  
  <row>
    <columns>
      
      <h1>Hi, {{$data['name']}}</h1>
      <p class="lead">На сайте <a href="{{url('/')}}">Black/White list</a> новый отзыв.</p>
      <p>Номер телефона - {{$data['phone']}}</p>
      <callout class="primary">
        <p>Отзыв - {{$data['review']}}</p>
      </callout>

    </columns>
  </row>
  
  <wrapper class="secondary">
    <spacer size="16"></spacer>
    <row>
      <columns small="12" large="6">
        <h5>Подробнее:</h5>
        <button ><a href="{{url('/')}}/client/{{$data['client']}}">Посмотреть</a></button>
      </columns>

    </row>
  </wrapper>

</container>