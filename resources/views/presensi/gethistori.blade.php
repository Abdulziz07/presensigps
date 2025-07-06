@if ($histori->isEmpty())
<div class="alert alert-warning text-center">
    <p>Data Belum Ada</p>
</div>
@endif
@foreach ($histori as $d)
<ul class="listview image-listview">
    <li>
        <div class="item">
            @php
            $path = Storage::url('upload/absensi'.$d->foto_in);
            @endphp
            <img src="{{ url($path) }}" alt="image" class="image">
            <div class="in">
                <div>
                    <b>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</b><br>
                </div>
            </div>
            @php
    $jamIn = \Carbon\Carbon::parse($d->jam_in)->format('H:i');

    // Tetapkan status default
    $status = 'bg-success';

    // Periksa kondisi terlambat
    if (
        ($jamIn >= '00:00:00' && $jamIn <= '04:00:00') || // Telat Shift 1
        ($jamIn >= '07:05:00' && $jamIn <= '13:00:00') || // Telat Shift 2
        ($jamIn >= '16:05:00' && $jamIn <= '21:00:00')
    ) {
        $status = 'bg-danger';
    }
@endphp

<span class="badge {{ $status }}">
    {{ $jamIn }}
</span>
            <span class="badge bg-primary" style="margin-left: 2em;">{{$d->jam_out}}</span>
        </div>
    </li>
</ul>


@endforeach