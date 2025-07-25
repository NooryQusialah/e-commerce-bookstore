<x-action-section>
    <x-slot name="title">
        {{ __('حذف الحساب') }}
    </x-slot>

    <x-slot name="description">
        {{ __('حذف حسابك نهائيًا.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. قبل حذف حسابك، يُرجى تنزيل أي بيانات أو معلومات ترغب بالاحتفاظ بها.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('حذف الحساب') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('حذف الحساب') }}
            </x-slot>

            <x-slot name="content">
                {{ __('هل أنت متأكد من رغبتك في حذف حسابك؟ بمجرد حذفه، سيتم حذف جميع موارده وبياناته نهائيًا. يُرجى إدخال كلمة مرورك لتأكيد رغبتك في حذف حسابك نهائيًا.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('site.password') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('الغاء') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('حذف الحساب') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
