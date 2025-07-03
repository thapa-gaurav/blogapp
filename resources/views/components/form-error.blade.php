@props(['name'])
@error($name)
<div class="form-text" style="color: red;font-size: small">{{$message}}</div>
@enderror
