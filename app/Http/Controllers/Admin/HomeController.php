<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\info_state;
use App\Models\info_city;
use App\Models\info_parishes;
use App\Models\Domain;
use App\Models\Benefit;
use App\Models\Multimedia;
use App\Models\laundry_types;
use App\Models\Type_Benefit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function index() {
        // Asumiendo que estás utilizando la autenticación por defecto de Laravel
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        
        // Obtener las propiedades del usuario actual y luego cargar la relación 'multimedia'
        $properties = Domain::where('user_id', $userId)->get()->load('multimedia');
        
        return view('admin.index', compact('properties'));
    }

    public function create(){
        $listing_types = DB::table('listing_type')->get();
        $states = DB::table('info_states')->get();
        $laundry_types = laundry_types::all();
        // Obtener los tipos de beneficios con sus beneficios asociados
        $typeBenefits = Type_Benefit::with('benefits')->get();
        return view('admin.create', compact('listing_types','laundry_types', 'states','typeBenefits',));
    }

    public function store(Request $request)
        {
            try {
                $messages = [
                    'type_property.required' => 'El campo tipo de propiedad es obligatorio.',
                    'max_price.required' => 'El campo precio máximo es obligatorio.',
                    'max_price.numeric' => 'El precio máximo debe ser un valor numérico.',
                    'max_price.min' => 'El precio máximo debe ser mayor o igual a cero.',
                    'min_price.numeric' => 'El precio mínimo debe ser un valor numérico.',
                    'min_price.min' => 'El precio mínimo debe ser mayor o igual a cero.',
                    'title.required' => 'El campo título es obligatorio.',
                    'title.string' => 'El título debe ser una cadena de texto.',
                    'title.max' => 'El título no debe exceder los 255 caracteres.',
                    'description.required' => 'El campo descripción es obligatorio.',
                    'description.string' => 'La descripción debe ser una cadena de texto.',
                    'bedroom.required' => 'El campo número de habitaciones es obligatorio.',
                    'bedroom.integer' => 'El número de habitaciones debe ser un valor entero.',
                    'bedroom.min' => 'El número de habitaciones no puede ser menor a cero.',
                    'bathroom.required' => 'El campo número de baños es obligatorio.',
                    'bathroom.integer' => 'El número de baños debe ser un valor entero.',
                    'bathroom.min' => 'El número de baños no puede ser menor a cero.',
                    'garage.required' => 'El campo número de garajes es obligatorio.',
                    'garage.integer' => 'El número de garajes debe ser un valor entero.',
                    'garage.min' => 'El número de garajes no puede ser menor a cero.',
                    'construction_area.required' => 'El campo área de construcción es obligatorio.',
                    'construction_area.numeric' => 'El área de construcción debe ser un valor numérico.',
                    'construction_area.min' => 'El área de construcción debe ser mayor o igual a cero.',
                    'state_province.required' => 'El campo provincia/estado es obligatorio.',
                    'state_province.string' => 'La provincia/estado debe ser una cadena de texto.',
                    'state_province.max' => 'La provincia/estado no debe exceder los 255 caracteres.',
                    'sector.required' => 'El campo sector es obligatorio.',
                    'sector.string' => 'El sector debe ser una cadena de texto.',
                    'sector.max' => 'El sector no debe exceder los 255 caracteres.',
                    'city.required' => 'El campo ciudad es obligatorio.',
                    'city.string' => 'La ciudad debe ser una cadena de texto.',
                    'city.max' => 'La ciudad no debe exceder los 255 caracteres.',
                    'address.required' => 'El campo dirección es obligatorio.',
                    'address.string' => 'La dirección debe ser una cadena de texto.',
                    'lat.required' => 'La latitud es obligatoria.',
                    'lat.numeric' => 'La latitud debe ser un valor numérico.',
                    'lng.required' => 'La longitud es obligatoria.',
                    'lng.numeric' => 'La longitud debe ser un valor numérico.',
                    'laundry_type.required' => 'El campo tipo de lavandería es obligatorio.',
                    'laundry_type.string' => 'El tipo de lavandería debe ser una cadena de texto.',
                    'laundry_type.max' => 'El tipo de lavandería no debe exceder los 255 caracteres.',
                    'benefits.required' => 'Debe seleccionar al menos un beneficio.',
                    'benefits.array' => 'El campo beneficios debe ser un arreglo.',
                    'benefits.*.exists' => 'El beneficio seleccionado no es válido.',
                ];
                // Aquí va tu lógica de validación y creación de la propiedad
                $validatedData = $request->validate([
                    'type_property' => 'required|string|max:255',
                    'max_price' => 'required|numeric|min:0',
                    'min_price' => 'nullable|numeric|min:0',
                    'title' => 'required|string|max:255',
                    'description' => 'required|string',
                    'bedroom' => 'required|integer|min:0',
                    'bathroom' => 'required|integer|min:0',
                    'garage' => 'required|integer|min:0',
                    'construction_area' => 'required|numeric|min:0',
                    'state_province' => 'required|string|max:255',
                    'sector' => 'required|string|max:255',
                    'city' => 'required|string|max:255',
                    'address' => 'required|string',
                    'lat' => 'required|numeric',
                    'lng' => 'required|numeric',
                    'laundry_type' => 'required|string|max:255',
                    'benefits' => 'required|array', // Asegúrate de que se hayan enviado beneficios
                    'benefits.*' => 'exists:benefits,id', // Asegúrate de que los beneficios existan
                ],$messages);
                // Agregar el user_id manualmente
                $validatedData['user_id'] = auth()->user()->id;
                $validatedData['is_negotiable'] = $request->boolean('is_negotiable', false);


                // Genera el code con iniciales en mayúsculas y un número aleatorio de 4 dígitos
                $initials = implode('', array_map(function ($word) { return strtoupper($word[0]); }, explode(' ', $request->title)));
                $randomNumber = mt_rand(1000, 9999); // Genera un número aleatorio entre 1000 y 9999
                $code = "HR-{$initials}{$randomNumber}";

                // Genera el slug y añade un número aleatorio de 4 dígitos al final
                $slug = Str::slug($request->title, '-') . '-' . mt_rand(1000, 9999);
                $slugBase = $slug;
                $count = 2;
                while (Domain::where('slug', $slug)->exists()) {
                    $slug = "{$slugBase}-{$count}";
                    $count++;
                }

                // Añade code y slug a $validatedData y otros datos validados...
                $validatedData['code'] = $code;
                $validatedData['slug'] = $slug;

                
                // Validación adicional para asegurar que min_price < max_price
                if (isset($validatedData['min_price']) && $validatedData['min_price'] >= $validatedData['max_price']) {
                    return back()->withErrors(['min_price' => 'El precio mínimo debe ser menor que el precio máximo.'])->withInput();
                }
                $property = Domain::create($validatedData);
                $property->benefits()->sync($request->input('benefits', []));
                Log::debug('Propiedad creada con datos validados: ', $validatedData);
               //return back()->with('success', 'Propiedad creada correctamente.');
               return redirect()->route('properties.upload', ['id' => $property->id])->with('success', 'Propiedad creada correctamente. Por favor, sube las imágenes de la propiedad.');

            } catch (\Illuminate\Validation\ValidationException $e) {
                // Registro de error de validación y redirección manual a la ruta deseada con los errores
                Log::error('Error de validación al crear la propiedad: ' . $e->getMessage());
        
                // Redirigir manualmente al usuario a la ruta deseada con los errores de validación
                return redirect()->route('property.create')
                                 ->withErrors($e->validator)
                                 ->withInput();
            } catch (\Exception $e) {
                // Registro de cualquier otro tipo de error y redirección manual a la ruta deseada con mensaje de error
                Log::error('Error al crear la propiedad: ' . $e->getMessage());
        
                return redirect()->route('property.create')
                                 ->withErrors(['error' => 'Error al crear la propiedad: ' . $e->getMessage()])
                                 ->withInput();
            }
            
        }

    public function getcities($state_id){
        $cities = info_city::where('state_id', $state_id)->get();
        return response()->json($cities);
    }
    public function getparishes($city_id){
        $parishes = info_parishes::where('city_id', $city_id)->get();
        return response()->json($parishes);
    }

    public function upload(Request $request, $id) {
        // Obtener los datos de la propiedad usando el $id pasado al método
        $property = Domain::with('multimedia')->findOrFail($id); // Asegúrate de tener una relación 'multimedia' definida en tu modelo Property
    
        // Pasar los datos de la propiedad a la vista
        return view('admin.upload', ['property' => $property]);
    }
    public function upload_images(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . rand(1000, 9999) . '.' . $extension;
                $mime_type = $file->getClientMimeType();
                $description = "Uploaded on " . now(); // O cualquier otra descripción que quieras agregar
    
                // Guardar el archivo en el storage local de Laravel
                $path = $file->storeAs("properties_images", $filename, 'public');
    
                // Crear registro en la base de datos para cada archivo
                Multimedia::create([
                    'domain_id' => $id,
                    'filename' => $path,
                    'mime_type' => $mime_type,
                    'description' => $description
                ]);
            }
    
            return response()->json(['success' => 'Images uploaded successfully']);
        } else {
            return response()->json(['error' => 'No files were uploaded.']);
        }
    }

    public function deleteImage(Request $request)
    {
        $id = $request->id; // ID del archivo a eliminar
        $image = Multimedia::findOrFail($id);
        
        // Eliminar el archivo del disco
        Storage::delete('public/' . $image->filename);
        
        // Eliminar el registro de la base de datos
        $image->delete();

        return response()->json(['success' => 'File deleted successfully']);
    }

    public function showImages($id)
    {
        $property = Domain::with('multimedia')->findOrFail($id);
        return view('admin.elements.property_images', ['property' => $property]);
    }


    public function edit($id)
    {
        // Cargar los datos necesarios para el formulario
        $listing_types = DB::table('listing_type')->get();
        $states = DB::table('info_states')->get();
        $laundry_types = laundry_types::all(); // Asegúrate de que la clase se llama `LaundryType`, no `laundry_types`
        $typeBenefits = Type_Benefit::with('benefits')->get(); // La convención de Laravel recomienda nombres de clases en CamelCase

        // Cargar la propiedad específica para editar
        $property = Domain::with(['benefits'])->findOrFail($id); // Asegúrate de cargar cualquier otra relación necesaria
        $cities = info_city::all();
        $parishes = info_parishes::all();
        // Enviar los datos a la vista
        return view('admin.edit', compact('property', 'listing_types', 'laundry_types', 'states', 'typeBenefits','cities','parishes'));
    }
    public function update(Request $request, $id)
    {
        try {
            // Busca la propiedad por ID
            $property = Domain::findOrFail($id);
            $messages = [
                'type_property.required' => 'El campo tipo de propiedad es obligatorio.',
                'max_price.required' => 'El campo precio máximo es obligatorio.',
                'max_price.numeric' => 'El precio máximo debe ser un valor numérico.',
                'max_price.min' => 'El precio máximo debe ser mayor o igual a cero.',
                'min_price.numeric' => 'El precio mínimo debe ser un valor numérico.',
                'min_price.min' => 'El precio mínimo debe ser mayor o igual a cero.',
                'title.required' => 'El campo título es obligatorio.',
                'title.string' => 'El título debe ser una cadena de texto.',
                'title.max' => 'El título no debe exceder los 255 caracteres.',
                'description.required' => 'El campo descripción es obligatorio.',
                'description.string' => 'La descripción debe ser una cadena de texto.',
                'bedroom.required' => 'El campo número de habitaciones es obligatorio.',
                'bedroom.integer' => 'El número de habitaciones debe ser un valor entero.',
                'bedroom.min' => 'El número de habitaciones no puede ser menor a cero.',
                'bathroom.required' => 'El campo número de baños es obligatorio.',
                'bathroom.integer' => 'El número de baños debe ser un valor entero.',
                'bathroom.min' => 'El número de baños no puede ser menor a cero.',
                'garage.required' => 'El campo número de garajes es obligatorio.',
                'garage.integer' => 'El número de garajes debe ser un valor entero.',
                'garage.min' => 'El número de garajes no puede ser menor a cero.',
                'construction_area.required' => 'El campo área de construcción es obligatorio.',
                'construction_area.numeric' => 'El área de construcción debe ser un valor numérico.',
                'construction_area.min' => 'El área de construcción debe ser mayor o igual a cero.',
                'state_province.required' => 'El campo provincia/estado es obligatorio.',
                'state_province.string' => 'La provincia/estado debe ser una cadena de texto.',
                'state_province.max' => 'La provincia/estado no debe exceder los 255 caracteres.',
                'sector.required' => 'El campo sector es obligatorio.',
                'sector.string' => 'El sector debe ser una cadena de texto.',
                'sector.max' => 'El sector no debe exceder los 255 caracteres.',
                'city.required' => 'El campo ciudad es obligatorio.',
                'city.string' => 'La ciudad debe ser una cadena de texto.',
                'city.max' => 'La ciudad no debe exceder los 255 caracteres.',
                'address.required' => 'El campo dirección es obligatorio.',
                'address.string' => 'La dirección debe ser una cadena de texto.',
                'lat.required' => 'La latitud es obligatoria.',
                'lat.numeric' => 'La latitud debe ser un valor numérico.',
                'lng.required' => 'La longitud es obligatoria.',
                'lng.numeric' => 'La longitud debe ser un valor numérico.',
                'laundry_type.required' => 'El campo tipo de lavandería es obligatorio.',
                'laundry_type.string' => 'El tipo de lavandería debe ser una cadena de texto.',
                'laundry_type.max' => 'El tipo de lavandería no debe exceder los 255 caracteres.',
                'benefits.required' => 'Debe seleccionar al menos un beneficio.',
                'benefits.array' => 'El campo beneficios debe ser un arreglo.',
                'benefits.*.exists' => 'El beneficio seleccionado no es válido.',
            ];
            // Validación de los datos enviados
            $validatedData = $request->validate([
                'type_property' => 'required|string|max:255',
                'max_price' => 'required|numeric|min:0',
                'min_price' => 'nullable|numeric|min:0',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'bedroom' => 'required|integer|min:0',
                'bathroom' => 'required|integer|min:0',
                'garage' => 'required|integer|min:0',
                'construction_area' => 'required|numeric|min:0',
                'state_province' => 'required|string|max:255',
                'sector' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string',
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
                'laundry_type' => 'required|string|max:255',
                'benefits' => 'required|array', // Asegúrate de que se hayan enviado beneficios
                'benefits.*' => 'exists:benefits,id', // Asegúrate de que los beneficios existan
            ], $messages);
            $validatedData['is_negotiable'] = $request->boolean('is_negotiable', false);

        // Si 'is_negotiable' no está marcado, establece 'min_price' a null
            if (!$validatedData['is_negotiable']) {
                $validatedData['min_price'] = null; // O considera usar '' si tu columna acepta strings vacíos
            }



            $slug = Str::slug($request->title, '-') . '-' . mt_rand(1000, 9999);
                $slugBase = $slug;
                $count = 2;
                while (Domain::where('slug', $slug)->exists()) {
                    $slug = "{$slugBase}-{$count}";
                    $count++;
                }
            $validatedData['slug'] = $slug;
            // Actualiza la propiedad con los datos validados
            $property->update($validatedData);

            // Si hay beneficios para sincronizar, actualiza la relación
            if ($request->has('benefits')) {
                $property->benefits()->sync($request->input('benefits'));
            }

            // Registro en log para seguimiento
            Log::info('Propiedad actualizada con éxito: ', $validatedData);

            // Redirecciona con un mensaje de éxito
            return redirect()->route('properties.index', $property->id)
                            ->with('success', 'Propiedad actualizada correctamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Manejo de errores de validación
            Log::error('Error de validación al actualizar la propiedad: ' . $e->getMessage());
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Manejo de cualquier otro error
            Log::error('Error al actualizar la propiedad: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error al actualizar la propiedad: ' . $e->getMessage()])->withInput();
        }
    }
    public function destroy($id)
    { // Solo para depuración, elimínalo después
        $property = Domain::find($id);
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada correctamente.');
    }

}


