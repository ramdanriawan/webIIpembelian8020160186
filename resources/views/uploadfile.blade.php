<form action='/uploadfile' method='post' enctype='multipart/form-data'>
    <input type="file" name="gambar">
    <input type="submit" name="submit">
    {{$errors->first('gambar')}}
    {{csrf_field()}}
</form>
