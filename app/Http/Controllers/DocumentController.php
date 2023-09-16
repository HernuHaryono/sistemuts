<?php

namespace App\Http\Controllers;

use App\Models\Borangdosen;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function deleteFile($borangId, $id_doc)
    {
        $docs = Document::where('id', $id_doc)->delete();
        return redirect()->route('listDocument', ['borangId' => $borangId]);
    }
    public function listDocument($borangId)
    {
        // dd($borangId);
        $borang =  Borangdosen::findOrfail($borangId);
        $docs = Document::where('borang_id', $borang->id)->orderBy('created_at', 'desc')->get();
        return view('Listfile', compact('borang', 'docs'));
    }
    public function formUpload($borangId)
    {
        // dd($borangId);
        try {
            $borang =  Borangdosen::findOrfail($borangId);
            // dd($borang);
        } catch (\Throwable $th) {
            // kembalikan ke halaman home dengan notif error jika terdapat kesalahan data borang
            // throw $th;
        }

        return view('upload-file', compact('borang'));
    }

    public function uploadDocument(Request $request, $borangId)
    {
        $request->validate([
            'document' => 'required|file'
        ]);

        try {
            $document = $request->file('document');
            $filename = $document->getClientOriginalName();
            $path = $request->file('document')->store('dokumen_borang', 'public');

            $document = Document::create([
                'path' => $path,
                'filename' => $filename,
                'borang_id' => $borangId,
            ]);
        } catch (\Throwable $th) {
            // kembalikan ke halaman form upload jika penyimpanan file gagal dengan pesan tertentu
        }
        return redirect()->route('home')->with('success', 'Upload berhasil! Dokumen berhasil disimpan');
    }

    public function formDownload($id)
    {

        $document = DB::table('documents')->where('id', $id)->first();
        //dd($document);
        //dd($id);
        //dd($document->path);
        $pathToFile = public_path('storage/' . $document->path);
        return Response::download($pathToFile);
    }

    public function validateStatus($id)
    {
        $document = DB::table('documents')->where('id', $id)->first();
        return response(200)->json([
            'message' => 'success'
        ]);
        // return Response::validate($pathToFile);
    }

    public function updatestatus($borangId, Request $request)
    {
        try {
            $borang = Borangdosen::findOrfail($borangId);
            $borang->update([
                'status' => $request->status
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'success' => false,
                'msg' => "Gagal update status",
                'error_msg' => $th->getMessage()
            ], 403);
        }
        return response([
            'success' => true,
        ], 200);
    }
}
