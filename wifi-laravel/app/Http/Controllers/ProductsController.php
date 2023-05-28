<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Repositories\ImageRepository;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Kreait\Firebase\Storage;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;

/**
 * Class ProductsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProductsController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected ProductRepository $repository;
    protected ImageRepository $imageRepository;

    /**
     * @var ProductValidator
     */
    protected $validator;

    const PERPAGE = 6;

    protected function chooseField($value, $fail, $message): void
    {
        if ($value == 0) {
            $fail($message);
        }
    }

    /**
     * ProductsController constructor.
     *
     * @param ProductRepository $repository
     * @param ImageRepository $imageRepository
     */
    public function __construct(ProductRepository $repository, ImageRepository $imageRepository)
    {
        $this->repository = $repository;
        $this->imageRepository = $imageRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $title = 'Danh sách sản phẩm';
        $filters = [];
        $keySearch = null;

        if (!empty($request->flag_promoted)) {
            $flag_promoted = $request->flag_promoted;
            if ($flag_promoted == 'active') {
                $flag_promoted = 1;
            } else {
                $flag_promoted = 0;
            }
            $filters[] = ['pr.flag_promoted', '=', $flag_promoted];
        }

        if (!empty($request->manufacture_id)) {
            $manufacture_id = $request->manufacture_id;
            $filters[] = ['pr.manufacture_id', '=', $manufacture_id];
        }

        if (!empty($request->keySearch)) {
            $keySearch = $request->keySearch;
        }
        $products = $this->repository->getAllProducts($filters, $keySearch, self::PERPAGE);

        $imageProduct = [];
        foreach ($products as $product) {
            $url = $product->imageUrl;
            $path = parse_url($url, PHP_URL_PATH);
            $filename = basename($path);
            $filename = str_replace('%2F', '/', $filename);
            $expiresAt = new \DateTime('tomorrow');
            $imageReference = app('firebase.storage')->getBucket()->object($filename);

            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            } else {
                $image = $product->imageUrl;
            }

            $imageProductItem = [
                'id' => $product->id,
                'image' => $image
            ];

            $imageProduct[] = $imageProductItem;
        }

        return view('clients.products.list', compact('products', 'title', 'imageProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới sản phẩm';

        return view('admin.products.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateRequest $request
     *
     * @return RedirectResponse
     *
     * @throws ValidatorException
     */
    public function store(ProductCreateRequest $request)
    {
        $product = [
            'code' => 'R-' . rand(1000, 9999),
            'name' => $request->name,
            'quantity_exists' => $request->quantity_exists,
            'description' => $request->description,
            'price' => $request->price,
            'size' => $request->size,
            'flag_promoted' => $request->flag_promoted,
            'coverage_density_id' => $request->coverage_density_id,
            'frequency_band_id' => $request->frequency_band_id,
            'guarantee_id' => $request->guarantee_id,
            'made_in_id' => $request->made_in_id,
            'manufacture_id' => $request->manufacture_id,
            'promotion_id' => $request->promotion_id,
            'speed_wifi_id' => $request->speed_wifi_id,
            'standard_network_id' => $request->standard_network_id,
            'type_anteing_id' => $request->type_anteing_id,
            'type_device_id' => $request->type_device_id,
            'user_connect_id' => $request->user_connect_id,
            'button_support_id' => $request->button_support_id,
            'port_id' => $request->port_id,
            'anteing_id' => $request->anteing_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->repository->saveProduct($product);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $productId = Product::latest()->first()->id;

            foreach ($images as $index => $file) {
                $imageName = uniqid() . '.' . $file->getClientOriginalExtension();

                $firebase_storage_path = 'Images/';

                $localFolder = public_path('storage/app/image') . '/';
                $object = '';
                if ($file->move($localFolder, $imageName)) {
                    $uploadedFile = fopen($localFolder . $imageName, 'r');
                    $object = app('firebase.storage')->getBucket()->upload($uploadedFile, [
                        'name' => $firebase_storage_path . $imageName,
                    ]);
                }

                $path = $object->info()['mediaLink'];
                $image = [
                    'url' => $path,
                    'product_id' => $productId,
                    'created_at' => now()->toDateTimeString(),
                ];

                $this->imageRepository->saveImage($image);

            }
        }

        return redirect()->route('products.index')->with('msg', 'Thêm mới sản phẩm thành công.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View|
     * \Illuminate\Foundation\Application|JsonResponse
     */
    public function show($id)
    {
        $product = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $product,
            ]);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function edit(int $id, Request $request)
    {
        $title = 'Chỉnh sửa sản phẩm';
        if (!empty($id)) {
            $productEdit = $this->repository->find($id);
            if (!empty($productEdit)) {
                $request->session()->put('id', $id);
            } else {
                return redirect()->route('products.index')->with('msg', 'Sản phẩm không tồn tại.');
            }
        } else {
            return redirect()->route('products.index')->with('msg', 'Sai đường dẫn.');
        }


        $imageEdit = $this->imageRepository->getImageByIdProduct($id);
        $images = [];
        foreach ($imageEdit as $item) {
            $idImage = $item->id;
            $url = $item->url;
            $path = parse_url($url, PHP_URL_PATH);
            $filename = basename($path);
            $filename = str_replace('%2F', '/', $filename);
            $expiresAt = new \DateTime('tomorrow');
            $imageReference = app('firebase.storage')->getBucket()->object($filename);

            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            } else {
                $image = $item->url;
            }

            $images[] = [
                'idImage' => $idImage,
                'image' => $image,
                'name' => str_replace('Images/', '', $filename)
            ];
        }

        return view('admin.products.edit', compact('productEdit', 'title', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductCreateRequest $request
     * @return RedirectResponse
     *
     */
    public function update(ProductCreateRequest $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'Sai đường dẫn.');
        }

        $productUpdate = [
            'code' => 'R-' . rand(1000, 9999),
            'name' => $request->name,
            'quantity_exists' => $request->quantity_exists,
            'description' => $request->description,
            'price' => $request->price,
            'size' => $request->size,
            'flag_promoted' => $request->flag_promoted,
            'coverage_density_id' => $request->coverage_density_id,
            'frequency_band_id' => $request->frequency_band_id,
            'guarantee_id' => $request->guarantee_id,
            'made_in_id' => $request->made_in_id,
            'manufacture_id' => $request->manufacture_id,
            'promotion_id' => $request->promotion_id,
            'speed_wifi_id' => $request->speed_wifi_id,
            'standard_network_id' => $request->standard_network_id,
            'type_anteing_id' => $request->type_anteing_id,
            'type_device_id' => $request->type_device_id,
            'user_connect_id' => $request->user_connect_id,
            'button_support_id' => $request->button_support_id,
            'port_id' => $request->port_id,
            'anteing_id' => $request->anteing_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->repository->updateProducts($productUpdate, $id);

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $index => $file) {
                $imageName = uniqid() . '.' . $file->getClientOriginalExtension();

                $firebase_storage_path = 'Images/';

                $localFolder = public_path('storage/app/image') . '/';
                $object = '';
                if ($file->move($localFolder, $imageName)) {
                    $uploadedFile = fopen($localFolder . $imageName, 'r');
                    $object = app('firebase.storage')->getBucket()->upload($uploadedFile, [
                        'name' => $firebase_storage_path . $imageName,
                    ]);
                }

                $path = $object->info()['mediaLink'];
                $image = [
                    'url' => $path,
                    'product_id' => $id,
                    'updated_at' => now()->toDateTimeString(),
                ];

                $idUpdateImage = 0;

                foreach ($request->input('idImage') as $indexIdImage => $value) {
                    if ($index == $indexIdImage) {
                        $idUpdateImage = $value;
                        break;
                    }
                }

                $product = Product::find($id);
                $product->image()->updateOrCreate([
                        'id' => $idUpdateImage
                    ], $image);


//                $this->imageRepository->updateImage($image, $idUpdateImage);
            }
        }

        return back()->with('msg', 'Sửa sản phẩm thành công.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->input('product_id');
        if (!empty($id)) {
            $productDelete = Product::find($id);
            if (!empty($productDelete)) {
                $productDelete->image()->delete($id);
                $deleteStatus = $productDelete->delete($id);

                if ($deleteStatus) {
                    $msg = 'Xóa sản phẩm ' . $productDelete->name . ' thành công.';
                } else {
                    $msg = 'Không thể xóa sản phẩm. Xin thử lại!!';
                }
            }else {
                $msg = 'Sản phẩm không tồn tại.';
            }

        }else {
            $msg = 'Sai đường dẫn. Kiểm tra lại id.';
        }
        return redirect()->route('products.index')->with('msg', $msg);
    }
}
