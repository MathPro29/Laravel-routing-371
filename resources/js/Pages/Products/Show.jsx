import { Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

// คอมโพเนนต์ Show รับ prop 'product' และแสดงรายละเอียดสินค้า
export default function Show({ product }) {
    // ฟังก์ชัน handlePurchase สำหรับแสดงข้อความแจ้งเตือนเมื่อคลิกปุ่ม Purchase
    const handlePurchase = () => {
        alert('Purchase success!'); // แสดงข้อความแจ้งเตือนเมื่อซื้อสำเร็จ
    };

    return (
        // ใช้ AuthenticatedLayout เป็นเลย์เอาต์หลักของหน้า
        <AuthenticatedLayout>
            {/* ลิงก์สำหรับกลับไปยังหน้ารายการสินค้าทั้งหมด */}
            <Link
                href="/products"
                className='mx-24 p-2 mt-4 inline-block text-black-500 hover:bg-grey-500 hover:text-black transition duration-300 hover:underline'>
                Back to All Products
            </Link>

            {/* คอนเทนเนอร์หลัก แบ่งพื้นที่แสดงข้อมูลสินค้าและรูปภาพ */}
            <div className="flex flex-col md:flex-row mt-4 container mx-auto">
                {/* คอลัมน์สำหรับแสดงรูปภาพสินค้า */}
                <div className="w-full md:w-1/2 p-4">
                    <img
                        src={product.images} // URL ของรูปภาพสินค้า
                        alt={product.name} // ข้อความสำรองเมื่อรูปภาพโหลดไม่ได้
                        className="w-full max-h-96 object-contain" // ปรับรูปภาพให้อยู่ในกรอบโดยไม่ถูกตัด
                    />
                </div>

                {/* คอลัมน์สำหรับแสดงข้อมูลสินค้า */}
                <div className="w-full md:w-1/2 p-4 mt-12">
                    {/* ชื่อสินค้า */}
                    <h1 className="text-2xl font-bold mb-2">{product.name}</h1>
                    {/* คำอธิบายสินค้า */}
                    <p className="mb-2">{product.description}</p>
                    {/* ราคา */}
                    <p className="text-xl font-semibold">ราคา {parseInt(product.price).toLocaleString()}.- บาท</p>

                    {/* ปุ่มสำหรับซื้อสินค้า */}
                    <button
                        onClick={handlePurchase} // เรียกฟังก์ชัน handlePurchase เมื่อคลิกปุ่ม
                        className='border p-2 rounded mt-4 mr-4 inline-block text-white bg-blue-500 hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105'
                    >
                        Purchase NOW
                    </button>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
