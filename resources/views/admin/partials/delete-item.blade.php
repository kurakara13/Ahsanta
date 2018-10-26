<button  class="btn btn-danger" onclick="event.preventDefault(); $(this).siblings('.delete-form').submit();">
    <i class="fa fa-trash"></i>
</button>

<form class="delete-form" action="{{ $route }}" method="POST" style="display: none;">
    @method('DELETE')
    @csrf
</form>
