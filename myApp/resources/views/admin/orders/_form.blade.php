@php
    $userId = old('user_id', optional($order)->user_id);
    $totalSms = old('total_sms', optional($order)->total_sms);
    $rate = old('rate', optional($order)->rate);
    $status = old('status', optional($order)->status);
@endphp

<div class="mb-3">
    <label for="user_id" class="form-label">User</label>
    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
        <option value="">-- Select User --</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @selected($userId == $user->id)>{{ $user->name }}</option>
        @endforeach
    </select>
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="total_sms" class="form-label">Total SMS</label>
    <input type="number" name="total_sms" id="total_sms" class="form-control @error('total_sms') is-invalid @enderror" value="{{ $totalSms }}" min="1" required>
    @error('total_sms')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="rate" class="form-label">Rate</label>
    <input type="number" name="rate" id="rate" class="form-control @error('rate') is-invalid @enderror" value="{{ $rate }}" step="0.01" min="0" required>
    @error('rate')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
        <option value="">-- Select Status --</option>
        @foreach (['pending', 'completed', 'cancelled'] as $s)
            <option value="{{ $s }}" @selected($status === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-between align-items-center">
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
</div>
