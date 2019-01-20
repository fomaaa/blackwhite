                <div class="panel-body">
                    @foreach ($clients as $client)
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 panel panel-default">
                            <div class="row">
                                <div class="col-md-4">{{trans('message.phone')}}</div>
                                <div class="col-md-4">{{trans('message.email')}}</div>
                                <div class="col-md-4">{{trans('message.date_add')}}</div>

                            </div>

                        </div>

                    </div>                     
                    <div class="row">
                        <a href="/client/{{$client->id}}">
                            <div class="col-md-10 col-md-offset-1 panel panel-default">
                                <div class="row">
                                    <div class="col-md-4">{{$client->phone}}</div>
                                    <div class="col-md-4">{{$client->email}}</div>
                                    <div class="col-md-4">{{$client->created_at}}</div>

                                </div>
                            </div>
                        </a>
                    </div>  
                    @endforeach
                     <div class="row nth-found">
                        
                            <div class="col-md-10 col-md-offset-1 panel panel-default">
                                <div class="row">
                                    <div class="col-md-10 ">
                                        {{trans('message.nth_fount')}}
                                    </div>
                                </div>
                            </div>
                    </div>  
                </div>