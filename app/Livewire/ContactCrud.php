<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactCrud extends Component
{
    public $contacts, $name, $contact_id;
    public $updateMode = false;

    public function render()
    {
        $this->contacts = Contact::all();
        return view('livewire.contact-crud');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->contact_id = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);

        Contact::create(['name' => $this->name]);
        session()->flash('message', 'Contact Created Successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $this->contact_id = $id;
        $this->name = $contact->name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        if ($this->contact_id) {
            $contact = Contact::find($this->contact_id);
            $contact->update(['name' => $this->name]);
            session()->flash('message', 'Contact Updated Successfully.');
            $this->resetInputFields();
            $this->updateMode = false;
        }
    }

    public function delete($id)
    {
        Contact::find($id)->delete();
        session()->flash('message', 'Contact Deleted Successfully.');
    }
}
