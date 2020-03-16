@include('admins.layout.header')

<form method="POST" enctype="multipart/form-data" action="{{ url("notadmin/category/add") }}">
    @csrf
    <input type="text" name="name" id="category_name" placeholder="Category name" required>

    <input id="slug" type="text" name="slug" placeholder="Category slug">

    <select name="parent" required>

        <option value="" disabled selected>Select Parent Category</option>
        <option value="root">Root Category</option>
        @foreach ($rootCategries as $rootCat)
        <option value="{{$rootCat->id}}">{{$rootCat->name}}</option>
        @include('admins.categories.subcats', ['cats' => $rootCat->children])
        @endforeach

    </select>



    <button type="submit" class="btn btn-primary">
        Add
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
        $('#slug').val($('#category_name').val().toLowerCase().split(' ').join('-'));

    });
</script>
