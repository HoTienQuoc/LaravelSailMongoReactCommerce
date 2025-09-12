import React, { useEffect, useState } from 'react'
import ImageGallery from "react-image-gallery"

export default function Slider({ product }) {
    const [images, setImages] = useState([])
    const [loaded, setLoaded] = useState(false)

    useEffect(() => {
        const handleProductImages = () => {
            let updatedImages = [
                {
                    original: product?.thumbnail,
                    thumbnail: product?.thumbnail,
                    originalHeight: 500
                }
            ]

            if (product?.first_image) {
                updatedImages.push({
                    original: product.first_image,
                    thumbnail: product.first_image,
                    originalHeight: 500
                })
            }

            if (product?.second_image) {
                updatedImages.push({
                    original: product.second_image,
                    thumbnail: product.second_image,
                    originalHeight: 500
                })
            }

            if (product?.third_image) {
                updatedImages.push({
                    original: product.third_image,
                    thumbnail: product.third_image,
                    originalHeight: 500
                })
            }

            setImages(updatedImages)
            setLoaded(true)
        }

        handleProductImages()
    }, [product]) // Add 'product' to dependencies if it's passed in asynchronously

    return (
        <ImageGallery 
            showPlayButton={loaded}
            showFullscreenButton={loaded}
            items={images}
        />
    )
}
