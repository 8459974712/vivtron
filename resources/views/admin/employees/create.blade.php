<x-app-layout>

<div class="py-8">
<div class="max-w-4xl mx-auto">

<div class="bg-white shadow rounded p-6">

<h2 class="text-2xl font-bold mb-6">
Create Employee
</h2>

<form method="POST" action="{{ route('admin.employees.store') }}">
@csrf

<div class="mb-4">
<label>Name</label>
<input type="text" name="name"
class="w-full border rounded p-2" required>
</div>

<div class="mb-4">
<label>Email</label>
<input type="email" name="email"
class="w-full border rounded p-2" required>
</div>

<div class="mb-4">
<label>Password</label>
<input type="password" name="password"
class="w-full border rounded p-2" required>
</div>

<hr class="my-6">

<h3 class="font-bold text-lg mb-3">
Employee Permissions
</h3>

<div class="grid grid-cols-2 gap-3">

<label><input type="checkbox" name="users_access"> Users</label>

<label><input type="checkbox" name="kyc_access"> KYC</label>

<label><input type="checkbox" name="sales_access"> Sales</label>

<label><input type="checkbox" name="income_access"> Income</label>

<label><input type="checkbox" name="withdrawal_access"> Withdrawals</label>

<label><input type="checkbox" name="reward_access"> Rewards</label>

<label><input type="checkbox" name="bank_access"> Bank Approval</label>

<label><input type="checkbox" name="rank_access"> Rank Settings</label>

<label><input type="checkbox" name="reward_setting_access"> Reward Settings</label>

<label><input type="checkbox" name="royalty_access"> Royalty Settings</label>

<label><input type="checkbox" name="level_access"> Level Settings</label>

<label><input type="checkbox" name="export_access"> Export Access</label>

</div>

<button
type="submit"
class="mt-6 bg-blue-600 text-white px-5 py-2 rounded">
Create Employee
</button>

</form>

</div>
</div>
</div>

</x-app-layout>