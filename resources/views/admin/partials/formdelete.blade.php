<form
  action="{{route('admin.travel.destroy', $travel)}}"
  method="POST"
    onsubmit="return confirm('Sei sicuro di voler cancellare '$travel->name' ?')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i
  class="fa-solid fa-trash-can"></i>
    </button>

</form>
