<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-4">
            Edit Reward
        </h2>

        <form action="{{ route('admin.reward.settings.update', $reward->id) }}"
              method="POST">

            @csrf

            <div class="mb-4">
                <label>Rank Name</label>
                <input type="text"
                       name="rank_name"
                       value="{{ $reward->rank_name }}"
                       class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Required Sales</label>
                <input type="number"
                       name="required_sales"
                       value="{{ $reward->required_sales }}"
                       class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Reward Amount</label>
                <input type="number"
                       name="reward_amount"
                       value="{{ $reward->reward_amount }}"
                       class="border p-2 w-full">
            </div>

            <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded">
                Update Reward
            </button>

        </form>

    </div>
</x-app-layout>