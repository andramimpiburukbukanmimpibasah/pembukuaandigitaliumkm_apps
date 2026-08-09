<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi Kas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <form method="POST" action="{{ route('cashes.update', $cash) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" type="date" name="tanggal" class="mt-1 block w-full" :value="old('tanggal', $cash->tanggal->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jenis" :value="__('Jenis')" />
                            <select id="jenis" name="jenis" class="mt-1 block w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm" required>
                                <option value="pemasukan" {{ old('jenis', $cash->jenis) === 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ old('jenis', $cash->jenis) === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <x-text-input id="kategori" type="text" name="kategori" class="mt-1 block w-full" :value="old('kategori', $cash->kategori)" required />
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="nominal" :value="__('Nominal (Rp)')" />
                            <x-text-input id="nominal" type="number" name="nominal" class="mt-1 block w-full" :value="old('nominal', $cash->nominal)" min="1" required />
                            <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="metode" :value="__('Metode')" />
                            <select id="metode" name="metode" class="mt-1 block w-full border-gray-300 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary rounded-xl py-2.5 px-3.5 shadow-sm" required>
                                <option value="Tunai" {{ old('metode', $cash->metode) == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                <option value="Transfer" {{ old('metode', $cash->metode) == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="QRIS" {{ old('metode', $cash->metode) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            </select>
                            <x-input-error :messages="$errors->get('metode')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <x-text-input id="keterangan" type="text" name="keterangan" class="mt-1 block w-full" :value="old('keterangan', $cash->keterangan)" />
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('cashes.index') }}" class="text-sm text-slate-600 hover:text-slate-900 font-medium">Batal</a>
                        <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
