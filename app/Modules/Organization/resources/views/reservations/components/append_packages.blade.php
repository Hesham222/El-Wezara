<select  class="form-control" name="package_id"
        id="package_id">

    @if(isset($record['package_id']))
        @if (!empty($allPackages))
            @foreach ($allPackages as $allPackage )
                <option value="{{ $allPackage['id'] }}"
                        @if (!empty($record['package_id']) && $record['package_id']== $allPackage->id )
                        selected =""
                    @endif
                >{{ $allPackage['name'] }}</option>
            @endforeach
        @endif
    @else
        <option value="">-- اختر اسم الحزمه --</option>
    @endif
    @if (!empty($packages))
        @foreach ($packages as $package )
            <option value="{{ $package['id'] }}"
                    @if (isset($record['package_id']) && $record['package_id']== $package->id )
                    selected =""
                @endif
            >{{ $package['name'] }}</option>
        @endforeach
    @endif
</select>
@error('package_id')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
