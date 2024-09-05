<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\Form;
use Illuminate\Http\Request;

class KycController extends Controller {
    public function setting() {
        $pageTitle = 'KYC Setting';
        $form      = Form::where('act', 'kyc')->first();
        $route     = route('admin.kyc.setting.update');
        return view('admin.kyc.setting', compact('pageTitle', 'form', 'route'));
    }

    public function settingUpdate(Request $request) {
        $formProcessor       = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $request->validate($generatorValidation['rules'], $generatorValidation['messages']);
        $exist = Form::where('act', 'kyc')->first();
        if ($exist) {
            $isUpdate = true;
        } else {
            $isUpdate = false;
        }
        $formProcessor->generate('kyc', $isUpdate, 'act');

        $notify[] = ['success', 'KYC data updated successfully'];
        return back()->withNotify($notify);
    }

    public function storeSetting() {
        $pageTitle = 'Vehicle Store KYC Setting';
        $form      = Form::where('act', 'store_kyc')->first();
        $route     = route('admin.kyc.store.setting.update');
        return view('admin.kyc.setting', compact('pageTitle', 'form', 'route'));
    }

    public function storeSettingUpdate(Request $request) {
        $formProcessor       = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $request->validate($generatorValidation['rules'], $generatorValidation['messages']);
        $exist = Form::where('act', 'store_kyc')->first();
        if ($exist) {
            $isUpdate = true;
        } else {
            $isUpdate = false;
        }
        $formProcessor->generate('store_kyc', $isUpdate, 'act');

        $notify[] = ['success', 'KYC data updated successfully'];
        return back()->withNotify($notify);
    }
}
