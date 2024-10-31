<div>
    @if (session()->has('message'))
        <div style="color: green">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
        <input type="text" wire:model="name" placeholder="Enter Name">
        <button type="submit">{{ $updateMode ? 'Update' : 'Add' }}</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>
                        <button wire:click="edit({{ $contact->id }})">Edit</button>
                        <button wire:click="delete({{ $contact->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
