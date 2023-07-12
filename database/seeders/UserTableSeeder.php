<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('users')->insert([
			// Admin seeder
			[
				'name'			=> 'Admin',
				'email'			=>	'admin@gmail.com',
				'password'	=> Hash::make('12345678'),
				'role'			=> 'admin',
				'status'		=> 'active',
			],

			// User seeder
			[
				'name'			=> 'Author',
				'email'			=>	'author@gmail.com',
				'password'	=> Hash::make('12345678'),
				'role'			=> 'author',
				'status'		=> 'active',
			],
		]);
	}
}
