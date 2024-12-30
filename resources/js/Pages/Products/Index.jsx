import { Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

// คอมโพเนนต์ Index รับ prop 'products' ซึ่งเป็นรายการสินค้า
export default function Index({ products }) {
    return (
        <>
            {/* ใช้ AuthenticatedLayout เป็นเลย์เอาต์หลัก */}
            <AuthenticatedLayout>
                <div className="max-w-6xl mx-auto p-4 sm:p-6 lg:p-3">
                    {/* ส่วนหัวของหน้า */}
                    <h1 className="text-center mb-4 text-2xl font-bold">Product Index</h1>

                    {/* แสดงรายการสินค้าในรูปแบบ grid layout */}
                    <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-6">

                        {/* วนลูปแสดงสินค้าทั้งหมด */}
                        {products.map((product) => (
                            <div key={product.id} className="p-2 border rounded shadow">

                                {/* เช็คว่ามีรูปภาพหรือไม่ */}
                                {product.images ? (
                                    <div className="max-w-full h-36 flex items-center justify-center bg-gray-100 rounded mb-2 ">
                                        {/* ลิงก์ไปยังหน้ารายละเอียดสินค้าด้วย ID */}
                                        <Link href={`/products/${product.id}`}>
                                            <img
                                                src={product.images} //รูปภาพสินค้า
                                                alt={product.name} // รูปภาพโหลดไม่ได้ให้แสดงข้อความนี้
                                                className="max-w-full max-h-36 object-contain" // ปรับขนาดให้ไม่เกินกรอบ
                                            />
                                        </Link>
                                    </div>
                                ) : (
                                    // แสดงข้อความถ้าไม่มีรูปภาพ
                                    <p className="text-gray-500">Missing Image</p>
                                )}

                                {/* ลิงก์ชื่อสินค้า */}
                                <Link
                                    href={`/products/${product.id}`}
                                    className="block text-lg font-bold pt-3">
                                    {product.name}
                                </Link>

                                {/* แสดงราคาสินค้า */}
                                <div className="text-blue-600 font-bold">{parseInt(product.price).toLocaleString()}.- บาท</div>
                            </div>
                        ))}
                    </div>
                </div>
            </AuthenticatedLayout>
        </>
    );
}
