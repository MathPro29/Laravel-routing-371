import { Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Index({ products }) {
    return (
        <>
        <AuthenticatedLayout>
        <div className="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <h1 className="text-center mb-4">Product Index</h1>
    <div className="grid grid-cols-5 gap-x-6 gap-y-6">
        {products.map((product) => (
            <div key={product.id} className="p-4 border rounded shadow">
                <Link href={`/products/${product.id}`}>
                    {product.name}
                </Link>
                <div className='text-blue-600'>
                <Link href={`/products/${product.price}`}>
                ${product.price}
                </Link>
                </div>

            </div>
        ))}
    </div>
</div>
            </AuthenticatedLayout>
        </>
    );
}
