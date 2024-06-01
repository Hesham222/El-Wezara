
    <div class="col-md-2">

    </div>

<tr>
    <td></td>
    <td>
        <ol>
            <li> مدين </li>
            <br>
            <li> دائن</li>
        </ol>
    </td>
    <td>
        <ol>
            <li> مدين </li>
            <br>
            <li> دائن</li>
        </ol>
    </td>
</tr>

@foreach($accounts as $account)
    @if(count($account->SubAccounts) == 0)
    <tr>
        <td>{{$account->name}}</td>
        <td>
            <ul>
                @foreach($debit_amounts as $key => $value)
                    @if($value == 0)
                        @continue($value)
                    @else
                        @if(count($account->Debits) > 0)
                        {{$value}}
                        @else
                            @continue($value)
                        @endif
                    @endif
                @endforeach
            </ul>
            <ul>
                @foreach($credit_amounts as $key => $value)
                    @if($value == 0)
                        @continue($value)
                    @else
                        @if(count($account->Credits) > 0)
                            {{$value}}
                        @else
                            @continue($value)
                        @endif
                    @endif
                @endforeach
            </ul>
        </td>
        <td>
            <ol>
                @foreach($temp as $key => $value)
                    <li>
                        @if($value >0)
                            @if($value == 0)
                                @continue($value)
                            @else
                                @if(count($account->Debits) > 0)
                                    {{$value}}
                                @elseif(count($account->Credits) > 0)
                                    {{$value}}
                                @else
                                    @continue($value)
                                @endif
                            @endif

                        @else
                            @if($value == 0)
                                @continue($value)
                            @else
                                @if(count($account->Debits) > 0)
                                    {{$value * -1}}
                                @elseif(count($account->Credits) > 0)
                                    {{$value * -1}}
                                @else
                                    @continue($value)
                                @endif
                            @endif
                        @endif
                    </li>



                @endforeach
            </ol>

        </td>

    </tr>
    @endif
@endforeach
@foreach($sub_accounts as $sub_account)
        <tr>
            <td>{{$sub_account->name}}</td>
            <td>
                <ul>
                    @foreach($debit_amounts_sub as $key => $value)
                        @if($value == 0)
                            @continue($value)
                        @else
                            @if(count($sub_account->Debits) > 0)
                                {{$value}}
                            @else
                                @continue($value)
                            @endif
                        @endif
                    @endforeach
                </ul>
                <ul>
                    @foreach($credit_amounts_sub as $key => $value)
                        @if($value == 0)
                            @continue($value)
                        @else
                            @if(count($sub_account->Credits) > 0)
                                {{$value}}
                            @else
                                @continue($value)
                            @endif
                        @endif
                    @endforeach
                </ul>
            </td>
            <td>
                <ol>
                    @foreach($temp_sub as $key => $value)
                        <li>
                            @if($value >0)
                                @if($value == 0)
                                    @continue($value)
                                @else
                                    @if(count($sub_account->Debits) > 0)
                                        {{$value}}
                                    @elseif(count($sub_account->Credits) > 0)
                                        {{$value}}
                                    @else
                                        @continue($value)
                                    @endif
                                @endif

                            @else
                                @if($value == 0)
                                    @continue($value)
                                @else
                                    @if(count($sub_account->Debits) > 0)
                                        {{$value * -1}}
                                    @elseif(count($sub_account->Credits) > 0)
                                        {{$value * -1}}
                                    @else
                                        @continue($value)
                                    @endif
                                @endif
                            @endif
                        </li>


                    @endforeach
                </ol>

            </td>
        </tr>
@endforeach
