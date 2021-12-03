import Data.List
import Data.Char


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


{- Exercise 3.1 Pratical sheet 3 -}

mapFilter :: (a -> b) -> (a -> Bool) -> [a] -> [b]
mapFilter f p l = map f (filter p l)

{- Exercise 3.2 Pratical sheet 3 -}

dec2int'' :: [Int] -> Int 
dec2int'' x = foldl times 0 x

times :: Int -> Int -> Int
times x y = x * 10 + y

dec2int' :: [Int] -> Int
dec2int' l = foldl (\ acc x -> (acc * 10) + x) 0 l

{- Exercise 3.3 Pratical sheet 3 -}

zipWith' :: (a->b->c) -> [a] -> [b] -> [c]
zipWith' _ _ [] = []
zipWith' _ [] _ = []
zipWith' f (x:xs) (y:ys) = f x y : (zipWith' f xs ys)

{- Exercise 3.4 Pratical sheet 3 -}

isort'' :: Ord a => [a] -> [a] 
isort'' a = foldr insert [] a

{- Exercise 3.5 Pratical sheet 3 -}

minimum' :: Ord a => [a] -> a
minimum' = foldl1 (\ x y -> if x >= y then y else x)

minimum'' :: Ord a => [a] -> a
minimum'' = foldr1 (\x y -> if x >= y then y else x)

maximum' :: Ord a => [a] -> a
maximum' = foldl1 (\ x y -> if x >= y then x else y)

maximum'' :: Ord a => [a] -> a
maximum'' = foldr1 (\ x y -> if x >= y then x else y)


{- Exercise 3.6 Pratical sheet 3 -}

mdc a b = until (\ (x,y) -> y == 0) (\ (x,y) ->  (y, mod x y)) (a,b)


{- Exercise 3.7 Pratical sheet 3 -}

pplus :: [a] -> [a] -> [a]
pplus xs ys = foldr (\ x y -> x:y) xs ys

concat' :: [[a]] -> [a]
concat' l = foldr (++) [] l

reverse' :: [a] -> [a]
reverse' l = foldr (\ x y -> y ++ x:[]) [] l

reverse'' :: [a] -> [a]
reverse'' l = foldl (\ x y -> y:x) [] l

elem' :: Eq a => a -> [a] -> Bool
elem' x ys = any (\ a -> a == x ) ys 

{- Exercise 3.8 Pratical sheet 3 -}

palavras :: String -> [String]
palavras = palavrasaux []

palavrasaux :: [String] -> String -> [String]
palavrasaux l "" = reverse l
palavrasaux l s = palavrasaux (firstWord : l) (if length rest > 0 then tail rest else "")
    where
        firstWord = takeWhile (\ch -> ch /= ' ') s
        rest = dropWhile (\ch -> ch /= ' ') s

despalavras :: [String] -> String
despalavras l = tail (foldr (\w acc -> ' ' : (w ++ acc)) "" l)
