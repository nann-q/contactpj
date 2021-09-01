<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\PostcodeRule;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
    public function confirm(Request $request)
    {
        $validate_rule=[
            'lastname'=>'required',
            'firstname'=>'required',
            'gender'=>'required',
            'email'=>'required|email',
            'postcode'=>['required',new PostcodeRule()],
            'address'=>'required',
            'building_name'=>'nullable',
            'opinion'=>'required|max:120',
        ];
        $this->validate($request,$validate_rule);
        // formから受け取ったinputの値を取得
        $inputs=$request->all();

        return view('contact.confirm',['inputs'=>$inputs]);
    }

    public function process(Request $request)
    {
        // formから受け取ったactionの値を取得
        $action=$request->input('action');
        // formから受け取ったactionを除いたinputの値を取得
        $inputs=$request->except('action');

        if($action !== 'submit')
        {
            return redirect()
            ->route('contact')
            ->withInput($inputs);
        }else{
            // DBに保存
            $contacts = new Contact;
            $contacts
            ->fill($inputs)
            ->save();

            return redirect()
            ->route('thanks');
        }
    }
    public function thanks(Request $request)
    {
        return view('contact.thanks');
    }

    // 管理画面
    public function manage()
    {
        $items=Contact::Paginate(10);

        return view('contact.manage',['items'=>$items]);

    }
    public function search(Request $request)
    {
        $keyword_fullname=$request->fullname;
        $keyword_gender=$request->gender;
        $keyword_from=$request->from;
        $keyword_until=$request->until;
        $keyword_email=$request->email;

        // 登録日
        if(empty($keyword_fullname) &&
        !empty($keyword_gender == 0) &&
        empty($keyword_email) &&
        !empty($request['from']) && !empty($request['until'])){
            $items=Contact::getDate($request['from'],$request['until']);
        }
        // メールアドレス
        elseif(empty($keyword_fullname) &&
        !empty($keyword_gender == 0) &&
        !empty($keyword_email) &&
        empty($request['from']) && empty($request['until'])){
            $query=Contact::query();
            $items=$query->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
        // お名前
        elseif(!empty($keyword_fullname) &&
        !empty($keyword_gender == 0) &&
        empty($keyword_email) &&
        empty($request['from']) && empty($request['until']) && empty($keyword_email)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->Paginate(10);
        }
        // 性別(全て)
        elseif(empty($keyword_fullname) &&
        !empty($keyword_gender == 0) &&
        empty($keyword_email) &&
        empty($request['from']) && empty($request['until']) && empty($keyword_email)){
            $items=Contact::Paginate(10);
        }
        // 性別(男性)
        elseif(empty($keyword_fullname) &&
        !empty($keyword_gender == 1) &&
        empty($keyword_email) &&
        empty($request['from']) && empty($request['until']) && empty($keyword_email)){
            $query=Contact::query();
            $items=$query->where('gender','1')->Paginate(10);
        }
        // 性別(女性)
        elseif(empty($keyword_fullname) &&
        !empty($keyword_gender == 2) &&
        empty($keyword_email) &&
        empty($request['from']) && empty($request['until']) && empty($keyword_email)){
            $query=Contact::query();
            $items=$query->where('gender','2')->Paginate(10);
        }
        // お名前、男性、登録日、メールアドレス
        elseif(!empty($request['from']) &&
        !empty($request['until']) &&
        !empty($keyword_fullname) &&
        !empty($keyword_email) &&
        !empty($keyword_gender == 1)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','1')->whereBetween("created_at",[$keyword_from,$keyword_until])->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
        // お名前、女性、登録日、メールアドレス
        elseif(!empty($request['from']) &&
        !empty($request['until']) &&
        !empty($keyword_fullname) &&
        !empty($keyword_email) &&
        !empty($keyword_gender == 2)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','2')->whereBetween("created_at",[$keyword_from,$keyword_until])->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
        // お名前、男性、登録日
        elseif(!empty($request['from']) &&
        !empty($request['until']) &&
        !empty($keyword_fullname) &&
        !empty($keyword_gender == 1)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','1')->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        // お名前、女性、登録日
        elseif(!empty($request['from']) &&
        !empty($request['until']) &&
        !empty($keyword_fullname) &&
        !empty($keyword_gender == 2)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','2')->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        // 男性、登録日、メールアドレス
        elseif(!empty($request['from']) &&
        !empty($request['until']) &&
        !empty($keyword_email) &&
        !empty($keyword_gender == 1)){
            $query=Contact::query();
            $items=$query->where('email','LIKE',"%{$keyword_email}%")->where('gender','1')->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        // 女性、登録日、メールアドレス
        elseif(!empty($request['from']) &&
        !empty($request['until']) &&
        !empty($keyword_email) &&
        !empty($keyword_gender == 2)){
            $query=Contact::query();
            $items=$query->where('email','LIKE',"%{$keyword_email}%")->where('gender','2')->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        // お名前、男性、メールアドレス
        elseif(!empty($keyword_fullname) &&
        !empty($keyword_gender == 1) &&
        !empty($keyword_email))
        {
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','1')->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
        // お名前、女性、メールアドレス
        elseif(!empty($keyword_fullname) &&
        !empty($keyword_gender == 2) &&
        !empty($keyword_email))
        {
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','2')->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
        // お名前、男性
        elseif(!empty($keyword_fullname) && !empty($keyword_gender == 1)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','1')->Paginate(10);
        }
        // お名前、女性
        elseif(!empty($keyword_fullname) && !empty($keyword_gender == 2)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('gender','2')->Paginate(10);
        }
        // お名前、メールアドレス
        elseif(!empty($keyword_fullname) &&
        !empty($keyword_email))
        {
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
        // 男性、メールアドレス
        elseif(!empty($keyword_gender == 1) &&
        !empty($keyword_email))
        {
            $query=Contact::query();
            $items=$query->where('gender','1')->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
        // 女性、メールアドレス
        elseif(!empty($keyword_gender == 2) &&
        !empty($keyword_email))
        {
            $query=Contact::query();
            $items=$query->where('gender','2')->where('email','LIKE',"%{$keyword_email}%")->Paginate(10);
        }
         // お名前、登録日
        elseif(!empty($request['from']) &&
        !empty($request['until']) && !empty($keyword_fullname)){
            $query=Contact::query();
            $items=$query->where('fullname','LIKE',"%{$keyword_fullname}%")
            ->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        // 男性、登録日
        elseif(!empty($request['from']) &&
        !empty($request['until']) &&
        !empty($keyword_gender == 1)){
            $query=Contact::query();
            $items=$query->where('gender','1')
            ->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        // 女性、登録日
        elseif(!empty($request['from']) &&
        !empty($request['until']) && !empty($keyword_gender == 2)){
            $query=Contact::query();
            $items=$query->where('gender','2')->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        // メールアドレス、登録日
        elseif(!empty($request['from']) &&
        !empty($request['until']) && !empty($keyword_email)){
            $query=Contact::query();
            $items=$query->where('email','LIKE',"%{$keyword_email}%")->whereBetween("created_at",[$keyword_from,$keyword_until])->Paginate(10);
        }
        return view('contact.manage',["items"=>$items]);
    }
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/contact/manage');
    }

}




