import Data.List


-- 3.2 Exercise

dec2int :: [Int] -> Int
dec2int l = foldl times 0 l

times :: Int -> Int -> Int
times x y = x * 10 + y

dec2int' :: [Int] -> Int
dec2int' l = foldl (\ acc x -> (acc * 10) + x) 0 l

-- 3.3 Exercise

mzipWith :: (a -> b -> c) -> [a] -> [b] -> [c]
mzipWith _ [] _ = []
mzipWith _ _ [] = []
mzipWith f (x:xs) (y:ys) = (f x y) : (mzipWith f xs ys)

-- 3.4 Exercise

iSort :: Ord a => [a] -> [a]
iSort l = foldr insert [] l

-- 3.6 Exercise

gcd' a b = until (\ (x,y) -> y == 0) (\ (x,y) -> (y, x `mod` y)) (a,b)
