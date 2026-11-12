<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Ringkasan -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800">
                    Selamat datang, {{ auth()->user()->name }}!
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    Buat dan kelola akun pegawai Anda di sini. Akun pegawai akan memakai dashboard yang sama,
                    namun hanya dapat melihat produk serta mencatat transaksi dan kas.
                </p>
            </div>

            <!-- Form Tambah Pegawai -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Tambah Akun Pegawai</h3>

                <form method="POST" action="{{ route('employees.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf

                    <div>
                        <x-input-label for="employee_name" :value="__('Nama Pegawai')" />
                        <x-text-input id="employee_name" type="text" name="name" class="mt-1 block w-full" :value="old('name')" placeholder="Nama pegawai" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="employee_email" :value="__('Email Pegawai')" />
                        <x-text-input id="employee_email" type="email" name="email" class="mt-1 block w-full" :value="old('email')" placeholder="pegawai@example.com" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="employee_password" :value="__('Password')" />
                        <x-text-input id="employee_password" type="password" name="password" class="mt-1 block w-full" placeholder="Minimal 8 karakter" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="employee_password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="employee_password_confirmation" type="password" name="password_confirmation" class="mt-1 block w-full" placeholder="Ulangi password" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2 flex items-end">
                        <p class="text-sm text-slate-500">
                            Pegawai akan terhubung ke usaha
                            <span class="font-semibold text-slate-700">{{ auth()->user()->umkm?->nama_usaha ?? '-' }}</span>
                            dan dapat melihat produk, menambah transaksi, serta menambah kas.
                        </p>
                    </div>

                    <div class="flex items-end">
                        <x-primary-button>
                            {{ __('Buat Akun Pegawai') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Daftar Pegawai -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6">
                <h3 class="font-semibold text-lg text-slate-800 mb-4">Daftar Pegawai</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Role</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($employees as $employee)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $employee->name }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-700">{{ $employee->email }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-brand-secondary/15 text-brand-secondary">
                                            Pegawai
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus akun pegawai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada pegawai yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
