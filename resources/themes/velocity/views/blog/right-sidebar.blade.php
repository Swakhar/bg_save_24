<div class="col-md-3 min_right">
        <div class="card">
          <div class="card-header">Latest</div>
          <div class="card-body">
            @foreach($recents as $recent)
              <a href="{{route('shop.about.blog_id',$recent->id)}}" style="color: black">{{$recent->headline}}</a>
              <hr>
            @endforeach
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header">Search Topic</div>
          <div class="card-body">
            <form method="POST" action="{{ route('shop.about.blog_search') }}" @submit.prevent="onSubmit" >
                @csrf()
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Enter keywords" name="search">
                  <div class="input-group-prepend">
                    <button style="width: 30px"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </form>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header">Search Within Date</div>
          <div class="card-body">
            <form method="POST" action="{{ route('shop.about.blog_date') }}" @submit.prevent="onSubmit" >
                @csrf()
                <div class="form-group">
                  From<input type="date" class="form-control-file border" name="from" required>
                </div>
                <div class="form-group">
                  To<input type="date" class="form-control-file border" name="to" required>
                </div>
                <center>
                  <button class="btn btn-primary btn-sm" type="submit">Search</button>
                </center>
            </form>
          </div>
        </div>
      </div>