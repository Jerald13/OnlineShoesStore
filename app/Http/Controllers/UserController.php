<?php

namespace App\Http\Controllers;

use App\Http\Controllers\StrategyPattern\EmailPasswordLogin;
use App\Http\Controllers\StrategyPattern\LoginContext;
use App\Http\Controllers\StrategyPattern\UsernamePasswordLogin;
use App\Models\Role;
use App\Models\User;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SimpleXMLElement;
use XSLTProcessor;

class UserController extends Controller
{
    public function usernameLoginForm(){
        return view('usernamelogin');
    }
    public function emailLoginForm(){
        return view('emaillogin');
    }
    public function adminLoginForm(){
        return view('adminlogin');
    }

    public function registerForm(){
        return view('register');
    }

    public function userList(){
        if(auth()->user()->getAttribute("isAdmin") != 1 || auth()->user()== null) {
            return redirect()->route('usernamelogin');
        }
        $users = User::all();
        return view('adminIndex', compact("users"));
    }

    public function importUserForm(){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        return view('importuser');
    }

    public function editUserForm($id){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        $user = User::find($id);
        return view('editUserForm', compact('user'));
    }

    public function login(Request $request){
        $method = $request->input('method');
        if($method == "usernameLogin"){
            if((new LoginContext(new UsernamePasswordLogin()))->login($request)){
                return redirect()->route('index');
            }else{
                return redirect()->route('usernamelogin')->with('error', 'Invalid Username & Password!!');
            }
        }else if($method == "emailLogin"){
            if((new LoginContext(new EmailPasswordLogin()))->login($request)){
                return redirect()->route('index');
            }else{
                return redirect()->route('usernamelogin')->with('error', 'Invalid Email & Password!!');
            }
        }else if($method == "adminLogin"){
            if((new LoginContext(new UsernamePasswordLogin()))->login($request)){
                return redirect()->route('adminIndex');
            }else{
                return redirect()->route('index')->with('error', 'Invalid Username & Password!!');
            }
        }
    }

    public function register(Request $request){
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:App\Models\User,username|',
            'email' => 'required|string|email|max:255|unique:App\Models\User,email|',
            'password' => 'required|string|min:8|regex:/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('usernamelogin');
    }

    /**
     * @throws ValidationException
     */
    public function editUserProfile(Request $request){

        if(auth()->user()->isAdmin != 1) {
            return redirect()->route('usernamelogin');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:App\Models\User,username|',
            'email' => 'required|string|email|max:255|unique:App\Models\User,email|',
            'password' => 'required|string|min:8|regex:/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $username = $request->input('username');
        $email = $request->input('email');
        $isAdmin = $request->has('isAdmin') ? 1 : 0;
        $id = $request->input('id');

        $user = User::find($id);

        $user->update([
            "username" => $username,
            "email" => $email,
            "isAdmin" => $isAdmin
        ]);

        $user->save();
        return redirect()->route('adminIndex');
    }

    public function displayImportedUser(Request $request){

        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }

        $file = $request->file('file');

        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimetypes:text/xml,application/xml',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $xmlDoc = new DOMDocument();
        $xmlDoc->load($file);

        $xsl = new DOMDocument();
        $xsl->load(public_path('xsl/user.xsl'));

        $processor = new XSLTProcessor();
        $processor->importStylesheet($xsl);
        $transformedXml = $processor->transformToXml($xmlDoc);

        // Load the transformed XML string as a DOMDocument
        $transformedDoc = new DOMDocument();
        $transformedDoc->loadXML($transformedXml);

        return view('confirmimportuser')->with([
                'originalXml' => $xmlDoc->saveXML(),
                'transformedXml' => $transformedXml,
        ]);
    }

    public function importUser(Request $request){

        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }

        $xml = new SimpleXMLElement($request->input('importXml'));

        foreach ($xml->children() as $child) {
            $username = (string)$child->username;
            $email = (string)$child->email;
            $password = (string) $child->password;
            $isAdmin = boolval($child->isAdmin);

            $validator = Validator::make([
                "username" => $username,
                "email" => $email
            ], [
                "username" => 'unique:App\Models\User,username',
                "email" => 'unique:App\Models\User,email'
            ]);

            if ($validator->fails()) {
                continue;
            }

            $user = User::create([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'isAdmin' => $isAdmin
            ]);

        }
        return redirect()->route('adminIndex');
    }
}
