@if($users->role != 'admin')
<form action="{!! route('users.destroy', $users->id) !!}" method="POST"
      onsubmit="return confirm('Do you want to delete this user?')">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <button type="submit" class="delete btn btn-danger btn-sm" title="Delete" data-toggle="tooltip"><i class="fas fa-trash"></i></button>
</form>
@else
    Administrator
@endif

