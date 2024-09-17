<tr @if($loop->odd) class='table-primary' @endif >
<th scope="row">{{ $users->firstItem() + $index }}</th>
<td>{{ $user->name }} </td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td width="150">

    @if($showTrashButton)
        <form action="{{route('users.restore',$user->id)}}"
              method="POST" onsubmit="askForTrash(event ,'Your user will be restored!')" style="display: inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-circle btn-outline-info"
                    title="Restore" ><i class="fa fa-undo"></i></button>
        </form>
        <form action="{{route('users.force-delete',$user->id)}}"
              method="POST" onsubmit="askForTrash(event,'Your user will be Deleted permanantly!')" style="display: inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-circle btn-outline-danger"
                    title="Delete Permenantly" ><i class="fa fa-undo"></i></button>
        </form>
    @else
    <a href="{{ route('users.show', ['user'=>$user->id]) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
    <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
    <form action="{{route('users.destroy',$user->id)}}"
          method="POST" onsubmit="askForTrash(event , 'Your user will be move to trash!')" style="display: inline">
        @csrf
        @method('DELETE')

        <button class="btn btn-sm btn-circle btn-outline-danger" title="Delete" ><i class="fa fa-trash"></i></button>
    </form>
    @endif

</td>
</tr>