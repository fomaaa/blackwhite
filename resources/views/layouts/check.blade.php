                <div class="panel-body">
                    @foreach ($clients as $client)
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 panel panel-default">
                            <div class="row">
                                <div class="col-md-2">Phone</div>
                                <div class="col-md-2">Email</div>
                                <div class="col-md-2">Data add</div>

                            </div>

                        </div>

                    </div>                     
                    <div class="row">
                        <a href="/client/{{$client->id}}">
                            <div class="col-md-10 col-md-offset-1 panel panel-default">
                                <div class="row">
                                    <div class="col-md-2">{{$client->phone}}</div>
                                    <div class="col-md-2">{{$client->email}}</div>
                                    <div class="col-md-2">{{$client->created_at}}</div>

                                </div>
                            </div>
                        </a>
                    </div>  
                    @endforeach
                     <div class="row nth-found">
                        
                            <div class="col-md-10 col-md-offset-1 panel panel-default">
                                <div class="row">
                                    <div class="col-md-10 ">
                                        Nothing found
                                    </div>
                                </div>
                            </div>
                    </div>  
                </div>