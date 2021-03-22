<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactsFormRequest;

class ContactsController extends Controller
{
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get contacts da DB
        $contacts = $this->contact->all();

        //titulo na Aba da página
        $title_page = 'Contatos - Listagem';
        
        return view('contact.index', compact('title', 'title_page', 'contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //titulo na Aba da página
        $title_page = 'Contatos - Cadastro';

        $educations = array('selecione' => 'Selecione', 'Analfabeto' => 'Analfabeto', 'Fundamental Completo' => 'Fundamental Completo', 'Médio Incompleto' => 'Médio Incompleto', 'Médio Completo' => 'Médio Completo', 'Superior Incompleto' => 'Superior Incompleto', 'Superior Completo' => 'Superior Completo', 'Mestrado' => 'Mestrado', 'Doutorado' => 'Doutorado');
        
        return view('contact.form', compact('title', 'title_page', 'educations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactsFormRequest $request)
    {
        //metodo de insersão no bd na tabela contacts
        $dataForm = $request->all();

        $dataForm['ip_address'] = \Request::ip();

        // Define o valor default para a variável que contém o nome da archivem 
        $nameFile = null;
     
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('archive') && $request->file('archive')->isValid()) {
             
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
     
            // Recupera a extensão do arquivo
            $extension = $request->archive->getClientOriginalExtension();
     
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->archive->storeAs('archives\contacts', $nameFile);

            if ( !$upload ) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $dataForm['archive'] = $nameFile;
            }
 
        } else {
            $dataForm['archive'] = null;
        }

        //sql run!!!
        $insert = $this->contact->create($dataForm);

        if ($insert) {
            
            // send email

            // $to      = 'nobody@example.com';
            // $subject = 'Cadastro de contato';
            // $message = '<h2>Cadastro de contato</h2>';
            // $message .= '<br>Nome: <p>'.$insert->name.'</p>';
            // $message .= '<br>Telefone: <p>'.$insert->phone.'</p>';
            // $message .= '<br>E-mail: <p>'.$insert->email.'</p>';
            // $message .= '<br>Cargo desejado: <p>'.$insert->desired_job.'</p>';
            // $message .= '<br>Escolaridade: <p>'.$insert->education.'</p>';
            // $message .= '<br><p>sitepublicadodeexemplo.com.br/'.$insert->archive.'</p>';
            // $headers = 'From: naoresponda@paytour.com.br' . "\r\n" .
            //     'X-Mailer: PHP/' . phpversion();

            // mail($to, $subject, $message, $headers);

            $title = 'Sucesso!';
            $title_page = 'Sucesso!';
            $status = 'Sucesso ao registrar contato de '.$insert->name;

            return view('contact.response', compact('title', 'title_page', 'status'));
            // return redirect()->route('contacts.show', $insert->id)->with(['status' => 'Sucesso ao criar contato']);
        } else {
            return redirect()->back()->withErrors(['errors' => 'Falha ao criar']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = $this->contact->find($id);

        //titulo na Aba da página
        $title_page = 'Contatos: '.$contact->name;

        $contact->created_at = $contact->created_at->toDateTimeString();

        
        return view('contact.show', compact('title', 'title_page', 'contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = $this->contact->find($id);

        $educations = array('selecione' => 'Selecione', 'Analfabeto' => 'Analfabeto', 'Fundamental Completo' => 'Fundamental Completo', 'Médio Incompleto' => 'Médio Incompleto', 'Médio Completo' => 'Médio Completo', 'Superior Incompleto' => 'Superior Incompleto', 'Superior Completo' => 'Superior Completo', 'Mestrado' => 'Mestrado', 'Doutorado' => 'Doutorado');

        //titulo na Aba da página
        $title_page = 'Contatos - Editar';
        
        return view('contact.form', compact('title', 'title_page', 'contact', 'educations'));
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
        $dataForm = $request->all();

        $contactUp = $this->contact->find($id);

        $dataForm['ip_address'] = \Request::ip();

        // Define o valor default para a variável que contém o nome da archivem 
        $nameFile = null;
     
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('archive') && $request->file('archive')->isValid()) {
             
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
     
            // Recupera a extensão do arquivo
            $extension = $request->archive->getClientOriginalExtension();
     
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->archive->storeAs('archives\contacts', $nameFile);

            if ( !$upload ) {
                return redirect()
                    ->back()
                    ->withErrors('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $dataForm['archive'] = $nameFile;
            }
 
        } else {
            $dataForm['archive'] = $contactUp->archive;
        }
        
        $update = $contactUp->update($dataForm);

        if ($update) {
            return redirect()->route('contacts.index')->with(['status' => 'Sucesso ao atualizar contato']);
        } else {
            return redirect()->route('contacts.edit', $id)->withErrors(['errors' => 'Falha ao editar']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contactDel = $this->contact->find($id);
        $delete = $contactDel->delete();

        if ($delete) {
            return redirect()->route('contacts.index')->with(['status' => 'Sucesso ao excluir contato']);
        } else {
            return redirect()->route('contacts.show', $id)->withErrors(['errors' => 'Falha ao deletar']);
        }
    }
}
