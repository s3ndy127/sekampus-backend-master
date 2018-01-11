<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitialConfigSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		app()['cache']->forget('spatie.permission.cache');

		// create permissions
		Permission::create(['name' => 'Administrator Content']);
		Permission::create(['name' => 'User Content']);
		Permission::create(['name' => 'Merchant Content']);

		// create roles and assign existing permissions
		$role = Role::create(['name' => 'Administrator']);
		$role->givePermissionTo('Administrator Content');

		$Userrole = Role::create(['name' => 'User']);
		$Userrole->givePermissionTo('User Content');

		$Merchantrole = Role::create(['name' => 'Merchant']);
		$Merchantrole->givePermissionTo('Merchant Content');

		$admin = User::create([
			'name' => 'Administrator',
			'email' => 'admin@test.com',
			'password' => bcrypt('123456'),
			'phone' => '021123123',
		]);

		$user = User::create([
			'name' => 'User',
			'email' => 'user@test.com',
			'password' => bcrypt('123456'),
			'phone' => '021123123',
		]);

		$merchant = User::create([
			'name' => 'Merchant',
			'email' => 'merchant@test.com',
			'password' => bcrypt('123456'),
			'phone' => '021123123',
		]);

		$admin->assignRole('Administrator');
		$user->assignRole('User');
		$merchant->assignRole('Merchant');
	}
}
