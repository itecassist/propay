<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-8">
                {{ __('global.menu.candidates') }}
            </div>
            <div class="col-sm-4 text-end">
                <div class="hstack gap-3">
                    <div><a href="{{ route('candidates.create') }}"><i class="fa fa-plus"></i></a></div>
                    <div><input  class="form-control form-control-sm" wire:model.debounce.200ms="pageSize" type="number"></div>
                    <div><input type="search" class="form-control form-control-sm" wire:model.debounce.200ms="searchTerm" placeholder="Search"/></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('candidates.fields.name') }}</th>
                    <th>{{ __('candidates.fields.sa_id') }}</th>
                    <th>{{ __('candidates.fields.email') }}</th>
                    <th>{{ __('candidates.fields.mobile_number') }}</th>
                    <th>{{ __('candidates.fields.date_of_birth') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $record)
                    <tr>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->sa_id }}</td>
                        <td>{{ $record->email }}</td>
                        <td>{{ $record->mobile_number }}</td>
                        <td>{{ $record->date_of_birth }}</td>
                        <th>
                            <div class="btn-group dropstart">
                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                      </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('candidates.show', $record->id) }}">Show</a></li>
                                    <li><a class="dropdown-item" href="{{ route('candidates.edit', $record->id) }}">Edit</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirmDelete({{ $record->id }})">Delete</a></li>
                                </ul>
                              </div>
                        </th>
                    </tr>
                @empty
                    <tr><td colspan="7">{{ __('global.no_results') }}</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    <form action="" method="POST">
        @csrf
        @method('DELETE')
    <div class="modal" tabindex="-1" id="deleteForm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('global.delete') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>{{ __('global.confirm_delete') }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger btn-sm">{{ __('global.delete') }}</button>
            </div>
          </div>
        </div>
    </div>
</form>
    @section('scripts')
<script>
    function confirmDelete(val){
        $('form').get(0).setAttribute('action', '/candidates/'+val);
        $('#deleteForm').modal('show');
    }
</script>
    @endsection
</div>
