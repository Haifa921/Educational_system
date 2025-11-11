<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;
use Hash;
class UserController extends Controller
{
    private $home_page_link="https://service.iust.edu.sy/administrative_new/public/index.php/home";
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        
        // if (!auth()->user()->can('المستخدمون')) {
        //     return redirect()->route('home')->with('error', 'لا يمكن تنفيذ الأمر المطلوب لعدم توفر السماحية لذلك!');
        // }
        
        // $data = User::orderBy('id','DESC')->paginate(5);
        
        // $data = User::orderBy('id','DESC')->paginate(100);
        // return view('users.show_users',compact('data'))
        // ->with('i', ($request->input('page', 1) - 1) * 5);

        $perPage = 100; // يمكن جعله متغيرًا أو إعداده من الإعدادات
        $data = User::orderBy('id', 'DESC')->paginate($perPage);
        
        return view('users.show_users')
            ->with([
                'data' => $data,
                'i' => ($request->input('page', 1) - 1) * $perPage
            ]);
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        // تحقق من الصلاحية أولاً إذا كنت تستخدمها
        // if (!auth()->user()->can('إضافة مستخدم')) {
        //     return redirect()->route('users.index')
        //         ->with('error', 'ليس لديك الصلاحية لإضافة مستخدمين');
        // }
        
        // تحقق إذا كان الملف موجود
        if (!view()->exists('users.Add_user')) {
            return redirect()->route('users.index')
                ->with('error', 'صفحة إضافة المستخدم غير متوفرة حالياً');
        }
        
        $roles = Role::pluck('name','name')->all();
        
        // تحقق إذا كان هناك أدوار متاحة
        if (empty($roles)) {
            return redirect()->route('users.index')
                ->with('error', 'لا توجد أدوار متاحة، يرجى إضافة الأدوار أولاً');
        }
        
        return view('users.Add_user', compact('roles'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // if (!auth()->user()->can('إضافة مستخدم')) {
        //     return redirect()->route('home')->with('error', 'لا يمكن تنفيذ الأمر المطلوب لعدم توفر السماحية لذلك!');
        // }
        
        // تسجيل بيانات الطلب للتحقق منها
        \Log::info('Store Request Data:', $request->all());
        
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required',
            'status' => 'required'
        ]);
        
        try {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            
            \Log::info('Input after processing:', $input);
    
            $user = User::create($input);
            \Log::info('User created successfully with ID: ' . $user->id);
            
            $user->assignRole($request->input('roles_name'));
            \Log::info('Role assigned successfully');
            
            return redirect()->route('users.index')
                ->with('success', 'تم اضافة المستخدم بنجاح');
                
        } catch (\Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage());
            \Log::error('Error trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إضافة المستخدم: ' . $e->getMessage());
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    // public function show($id)
    // {
    // $user = User::find($id);
    // return view('users.show',compact('user'));
    // }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        // if (!auth()->user()->can('تعديل مستخدم')) {
        //     return redirect()->route('home')->with('error', 'لا يمكن تنفيذ الأمر المطلوب لعدم توفر السماحية لذلك!');
        // }
        
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'owner')->pluck('name', 'name');
        $userRole = $user->roles->pluck('name', 'name')->all();
        
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        // if (!auth()->user()->can('تعديل مستخدم')) {
        //     return redirect()->route('home')->with('error', 'لا يمكن تنفيذ الأمر المطلوب لعدم توفر السماحية لذلك!');
        // }
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => ''
        ]); 
        $input = $request->all();
        if(!empty($input['password'])){
        $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, ['password']);
        }
        $user = User::find($id);
        $user->update($input);
        if($request->input('roles') != null){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
        }
        return redirect()->route('users.index')
        ->with('success','تم تحديث معلومات المستخدم بنجاح');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    {
        // if (!auth()->user()->can('حذف مستخدم')) {
        //     return redirect()->route('home')->with('error', 'لا يمكن تنفيذ الأمر المطلوب لعدم توفر السماحية لذلك!');
        // }
        User::find($request->user_id)->delete();
        return redirect()->route('users.index')->with('success','تم حذف المستخدم بنجاح');
    }
}