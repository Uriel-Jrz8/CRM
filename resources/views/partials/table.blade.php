<table class="table table-responsive table-hover">
    @forelse ($query as $query)
        @if ($loop->first)
            <thead class="thead-dark">
                <tr>@foreach ($query as $key => $value )
                        <th>{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody>
            <tr>@foreach ($query as $key => $value )
                    <th>{{$value}}</th>
                @endforeach
            </tr>
        </tbody>
    @empty
        No hay Resultados
    @endforelse
</table>
