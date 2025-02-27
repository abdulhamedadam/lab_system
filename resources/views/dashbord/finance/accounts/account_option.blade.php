<option value="{{ $account->id }}" @if(old('parent_id',$record['parent_id']) == $account->id) selected  @endif>{{ $prefix . $account->name }}</option>
@if ($account->children->isNotEmpty())
    @foreach ($account->children as $child)
        @include('dashbord.finance.accounts.account_option', ['account' => $child, 'prefix' => $prefix . '-- '])
    @endforeach
@endif
