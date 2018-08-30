<?php

namespace App\Http\Controllers\Admin\Import;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\ImportDataRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Import\ImportData;
use App\Models\Account;
use App\Models\Title;
use App\Models\Account_type;
use App\Models\Contact;
use App\Models\Contact_type;
use App\Models\Office;
use App\Models\Contact_detail;
use App\Models\Contact_detail_type;
use App\Models\Web_site;
use App\Models\Web_site_type;
use App\Models\Address;
use App\Models\Address_type;



use App\Http\Requests\ImportDataRequest as ImportRequest;

class ImportController extends \App\Http\Controllers\Controller
{
    public function getImport()
    {
        return view('inf.import.import');
    }

    public function processImport(ImportRequest $request)
    {
            $path = $request->file('csv_file')->getRealPath();
            if ($request->has('header')) {
                $data = Excel::load($path, function($reader) {})->get()->toArray();
            } else {
                $data = array_map('str_getcsv', file($path));
            }

            if (count($data) > 0) {
                $import_result = [];
                config(['informa.config.audit_elaboration' => 'import '.\Carbon\Carbon::now()->toDateTimeString()]);
                if ($request->has('header')) {
                    $csv_header_fields = [];
                    foreach ($data[0] as $key => $value) {
                        $csv_header_fields[] = $key;
                    }
                }
                $suffix_model_import = explode(',','account,contact,contactd,web_site,address');
                foreach ($data[0] as $key => $value) {
                    foreach ($suffix_model_import as $index => $fieldSuffix) {
                        // $modelType = explode('.', $fieldName);
                        // $i = 3;
                        // dd($key,(array_key_exists('contact.'.$i.'.office',$value)) ? $value['contact.'.$i.'.office'] : 'no' );
                        switch ($fieldSuffix) {
                            case 'account':
                                //**account
                                // dd($data,$value);
                                $account = Account::create([
                                    'title_id' => (!$value['account.title']) ? null : Title::firstOrCreate(['description' => $value['account.title']])->id,
                                    'is_person' => ($value['account.is_person'] == '1') ? 1 : 0 ,
                                    'name1' => $value['account.name1'],
                                    'name2' => $value['account.name2'],
                                    'vat_number' => $value['account.vat_number'],
                                    'fiscal_code' => $value['account.fiscal_code'],
                                    'notes' => $value['account.notes'],
                                ]);
                                // $import_result[$account->name1] = $account;

                                // **account_account_types
                                $types_to_import = explode(', ',$value['account.types']);
                                $types_id_to_import = [];
                                foreach ($types_to_import as $key => $typeDescription) {
                                    $types_id_to_import[] = Account_type::firstOrCreate(['description' => $typeDescription])->id;
                                }
                                $account->account_types()->syncWithoutDetaching($types_id_to_import);
                                $import_result[$account->name1]['account_types.id'] = $types_id_to_import;
                                break;
                            case 'contact':
                                //**contacts
                                $i = 1;
                                while (array_key_exists('contact.'.$i.'.first_name',$value)) {
                                    $fullName = $value['contact.'.$i.'.first_name'].$value['contact.'.$i.'.last_name'];
                                    if (!($fullName)) {

                                    } else {
                                        $contact[$i] = ['account_id' => $account->id,
                                                    'contact_type_id' => (!$value['contact.'.$i.'.type']) ? null : Contact_type::firstOrCreate(['description' => $value['contact.'.$i.'.type']])->id,
                                                    'office_id' => (!$value['contact.'.$i.'.office']) ? null : Office::firstOrCreate(['description' => $value['contact.'.$i.'.office']])->id,
                                                    'title_id' => (!$value['contact.'.$i.'.title']) ? null : Title::firstOrCreate(['description' => $value['contact.'.$i.'.title']])->id,
                                                    'first_name' => $value['contact.'.$i.'.first_name'],
                                                    'last_name' => $value['contact.'.$i.'.last_name'],
                                                    'notes' => $value['contact.'.$i.'.notes'],];
                                                    if ($contact[$i]) {
                                                        $contactInsert = Contact::create($contact[$i]);
                                                        $import_result[$account->name1][$fieldSuffix.$i] = $contact[$i];
                                                        //***contact details
                                                        $ii = 1;
                                                        while (array_key_exists('contactd.'.$i.'.detail.'.$ii.'.value',$value)) {
                                                            if ( !$value['contactd.'.$i.'.detail.'.$ii.'.value'] ) {

                                                            } else {
                                                                $contactd[$ii] = ['contact_id' => $contactInsert->id,
                                                                    'contact_detail_type_id' => (!$value['contactd.'.$i.'.detail.'.$ii.'.type']) ? null : Contact_detail_type::firstOrCreate(['description' => $value['contactd.'.$i.'.detail.'.$ii.'.type']])->id,
                                                                    'communication_type_id' => $value['contactd.'.$i.'.detail.'.$ii.'.communication'],
                                                                    'value' => $value['contactd.'.$i.'.detail.'.$ii.'.value'],
                                                                    'notes' => $value['contactd.'.$i.'.detail.'.$ii.'.notes'],];
                                                                Contact_detail::create($contactd[$ii]);
                                                                // $import_result[$account->name1][$fieldSuffix]['contact_details'.$ii] = $contactd[$ii];
                                                            }
                                                            $ii++;
                                                        }

                                                    }
                                    }
                                    $i++;
                                }
                                break;
                            case 'web_site':
                                //**web_site
                                $i = 1;
                                while (array_key_exists('web_site.'.$i.'.url',$value)) {
                                    if ( !$value['web_site.'.$i.'.url'] ) {

                                    } else {
                                        $web_site[$i] = ['account_id' => $account->id,
                                            'web_site_type_id' => (!$value['web_site.'.$i.'.type']) ? null : Web_site_type::firstOrCreate(['description' => $value['web_site.'.$i.'.type']])->id,
                                            'url' => $value['web_site.'.$i.'.url'],
                                            'notes' => $value['web_site.'.$i.'.notes'],];
                                        Web_site::create($web_site[$i]);
                                        $import_result[$account->name1][$fieldSuffix.$i] = $web_site[$i];
                                    }
                                    $i++;
                                }
                                break;
                            case 'address':
                                //**address
                                $i = 1;
                                while (array_key_exists('address.'.$i.'.address_line_1',$value)) {
                                    if ( !$value['address.'.$i.'.address_line_1'] ) {

                                    } else {
                                        $address[$i] = ['account_id' => $account->id,
                                            'address_type_id' => (!$value['address.'.$i.'.type']) ? null : Address_type::firstOrCreate(['description' => $value['address.'.$i.'.type']])->id,

                                            'address_line_1' => $value['address.'.$i.'.address_line_1'],
                                            'stree_number' => $value['address.'.$i.'.stree_number'],
                                            'postal_code' => $value['address.'.$i.'.postal_code'],
                                            'city' => $value['address.'.$i.'.city'],
                                            'province' => $value['address.'.$i.'.province'],
                                            'country' => $value['address.'.$i.'.country'],
                                            'notes' => $value['address.'.$i.'.notes'],];
                                        Address::create($address[$i]);
                                        $import_result[$account->name1][$fieldSuffix.$i] = $address[$i];
                                    }
                                    $i++;
                                }
                                break;
                            default:
                                // code...
                                break;
                        }
                    }
                }
                //
                //
                // $csv_data = array_slice($data, 0, 2);
                // dd($data,$csv_data,$csv_header_fields);
                // $csv_data_file = ImportData::create([
                //     'filename' => $request->file('csv_file')->getClientOriginalName(),
                //     'header' => $request->has('header'),
                //     'data' => json_encode($data)
                // ]);
                config(['informa.config.audit_elaboration' => '']);
            } else {
                return redirect()->back();
            }
            dd($import_result);
            return view('inf.import.import_success', 'import_result');

    }
}
