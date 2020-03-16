@include('admins.layout.header')

        <form method="POST" enctype="multipart/form-data" action="{{ url("notadmin/category/update") }}">
        @csrf
            <input type="hidden" name="category_id" value="{{$category->id}}">
              <input type="text" name="name" id="category_name" placeholder="Category name" value="{{$category->name}} required>

              <input id="slug" type="text" name="slug"  value="{{$category->slug}}  placeholder="Category slug">

              <select name="parent">
                @foreach ($categories as $category)
                  @if ($category->parent_id == NULL)
                    <option value="root" selected>Root Category</option>

                  @else
                    <option value="root" selected>Root Category</option>

                  @endif

                @endforeach
              <option value="root">Root Category</option>
              </select>


              <button type="submit" class="btn btn-primary">
                      UPDATE
              </button>





        </form>

        @if(Session::has('success'))

    <div id="successMessage" class="alert-message">


        {{Session::get('success')}}
    </div>
@endif



@include('admins.layout.footer')
<script type="text/javascript">

//slug
$('#category_name').on('change', function() {
$('#slug').val($('#location_name').val().toLowerCase().split(' ').join('-'));

});

</script>
