import Data.List


pitagoricos :: Int -> Int -> Int -> Bool
pitagoricos x y z 
    | res^2 == min1^2 + min2^2 = True 
    | otherwise = False
    where res = max z (max x y)
          min1 = min x y
          min2 = min z y 

hipotenusa :: Float -> Float -> Float
hipotenusa x y = sqrt(x**2 + y**2)

diferentes :: Eq a => [a] -> [a]
diferentes [] = []
diferentes [x] = [x]
diferentes (x:y:xs)
    | x /= y = x : diferentes(y:xs)
    | otherwise = diferentes(y:xs)

diferentes' :: Eq a => [a] -> [a]
diferentes' x = [ x | (x,y) <- zip x (tail x), x /= y]

zip3' :: [a] -> [a] -> [String] -> [(a,a,String)]
zip3' x y s = [(a,b,c) | (a,(b,c)) <- zip x (zip y s)]


partir :: Int -> [a] -> ([a],[a])
partir = splitAt

partir' :: Eq a => a -> [a] -> ([a],[a])
partir' _ [] = ([],[])
partir' n (x:xs)
    | n == x = ([],x:xs)
    | otherwise = (x:xs1,xs2) 
    where (xs1,xs2) = partir' n xs

flip' f x y = f y x



distancia a b = sqrt( ((fst b)^2 - (fst a)^2) + ((snd b)^2 - (snd a)^2))

colineares a b c 
    | dec1 == dec2 = True
    | otherwise = False
    where dec1 = (snd b - snd a) / (fst b - fst a)
          dec2 = (snd c - snd b) / (fst c - fst b)


niguais :: Int -> a -> [a]
niguais = replicate

niguais' :: Int -> a -> [a]
niguais' x y = [y | k <- [1..x]]

niguais'' :: Int -> a -> [a]
niguais'' 0 _ = []
niguais'' x y = y : (niguais'' (x-1) y)

merge :: Ord a => [a] -> [a] -> [a]
merge [] ys = ys
merge (x:xs) (ys) = merge xs (insert x ys) 

length_zip :: [a] -> [(Int,a)]
length_zip xs = [(x,y) | (x,y) <- zip l xs] 
    where l = reverse ([1..length xs])


troco :: Int -> [Int]
troco 0 = []
troco a = (troco (div a 10)) ++ [mod a 10]